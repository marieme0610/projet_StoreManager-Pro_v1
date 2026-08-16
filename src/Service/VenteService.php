<?php


/**
 * VenteService
 *
 * Service métier chargé de valider une vente au comptoir (POS).
 * Responsabilités :
 *  - Vérifier la disponibilité du stock pour chaque ligne du panier
 *  - Calculer le total et le reste à payer
 *  - Appliquer le contrôle de la limite de crédit client (si vente à crédit)
 *  - Décrémenter le stock, créer la commande, et créer/mettre à jour la dette
 *    le tout dans UNE SEULE transaction PDO (atomicité garantie)
 */
class VenteService
{
    private PDO $pdo;
    private ProduitRepository $produitRepository;
    private ClientRepository $clientRepository;
    private CommandeRepository $commandeRepository;
    private DetteRepository $detteRepository;

    public function __construct(
        ProduitRepository $produitRepository,
        ClientRepository $clientRepository,
        CommandeRepository $commandeRepository,
        DetteRepository $detteRepository
    ) {
        // Le Singleton Database (Step 1.3) nous fournit toujours la même connexion PDO
        
        $this->pdo = Database::getInstance()->getConnection();
        $this->produitRepository = $produitRepository;
        $this->clientRepository = $clientRepository;
        $this->commandeRepository = $commandeRepository;
        $this->detteRepository = $detteRepository;
    }



    public function validerVente(array $panier, ?int $clientId, float $montantVerse, string $modePaiement = 'ESPECES'): array
    {
        if (empty($panier)) {
            throw new InvalidArgumentException("Le panier ne peut pas être vide.");
        }
        if ($montantVerse < 0) {
            throw new InvalidArgumentException("Le montant versé ne peut pas être négatif.");
        }

        $this->pdo->beginTransaction();

        try {
           
            $lignesValidees = [];
            $totalVente = 0.0;

            foreach ($panier as $ligne) {
                $produitId = (int) $ligne['id'];
                $quantite  = (int) $ligne['qty'];

                if ($quantite <= 0) {
                    throw new InvalidArgumentException("Quantité invalide pour le produit #$produitId.");
                }

                $produit = $this->produitRepository->findById($produitId);
                if ($produit === null) {
                    throw new RuntimeException("Produit #$produitId introuvable.");
                }

                if ($produit->getStock() < $quantite) {
                    throw new RuntimeException(
                        "Stock insuffisant pour \"{$produit->getNom()}\" (disponible : {$produit->getStock()}, demandé : $quantite)."
                    );
                }

                // calculer sous total

                $sousTotal = $produit->getPrixVente() * $quantite;
                $totalVente += $sousTotal;

                $lignesValidees[] = [
                    'produit'    => $produit,
                    'quantite'   => $quantite,
                    'prix_unit'  => $produit->getPrixVente(),
                    'sous_total' => $sousTotal,
                ];
            }

           
            $resteAPayer = $totalVente - $montantVerse;
            if ($resteAPayer < 0) {
                $resteAPayer = 0.0;
            }

            $client = null;
            if ($clientId !== null) {
                $client = $this->clientRepository->findById($clientId);
                if ($client === null) {
                    throw new RuntimeException("Client #$clientId introuvable.");
                }
            }

            if ($resteAPayer > 0) {
                if ($client === null) {
                    throw new RuntimeException("Une vente à crédit nécessite un client identifié.");
                }

                $detteActuelle = $this->detteRepository->getTotalDettesNonSoldees($client->getId());
                $nouvelEncours = $detteActuelle + $resteAPayer;

                if ($nouvelEncours > $client->getLimiteCredit()) {
                    throw new RuntimeException(
                        "Limite de crédit dépassée pour {$client->getNom()} : " .
                        "encours actuel {$detteActuelle} + nouveau crédit {$resteAPayer} " .
                        "> limite autorisée {$client->getLimiteCredit()}."
                    );
                }
            }

         
            foreach ($lignesValidees as $ligneValidee) {
                $produit = $ligneValidee['produit'];
                $nouveauStock = $produit->getStock() - $ligneValidee['quantite'];

                $ok = $this->produitRepository->decrementerStock(
                    $produit->getId(),
                    $ligneValidee['quantite']
                );

                if (!$ok) {
                    throw new RuntimeException(
                        "Conflit de stock détecté pour \"{$produit->getNom()}\" pendant la transaction."
                    );
                }
            }

           
            $commandeId = $this->commandeRepository->create([
                'client_id'      => $client?->getId(),
                'total'          => $totalVente,
                'montant_verse'  => $montantVerse,
                'reste_a_payer'  => $resteAPayer,
                'mode_paiement'  => $modePaiement,
                'statut'         => $resteAPayer > 0 ? 'A CREDIT' : 'REGLE',
            ]);

            foreach ($lignesValidees as $ligneValidee) {
                $this->commandeRepository->addLigne($commandeId, [
                    'produit_id'    => $ligneValidee['produit']->getId(),
                    'quantite'      => $ligneValidee['quantite'],
                    'prix_unitaire' => $ligneValidee['prix_unit'],
                    'sous_total'    => $ligneValidee['sous_total'],
                ]);
            }

          
            if ($resteAPayer > 0) {
                $this->detteRepository->create([
                    'client_id'   => $client->getId(),
                    'commande_id' => $commandeId,
                    'montant'     => $resteAPayer,
                    'statut'      => 'NON_SOLDEE',
                ]);
            }

            $this->pdo->commit();

            return [
                'commande_id'   => $commandeId,
                'total'         => $totalVente,
                'reste_a_payer' => $resteAPayer,
            ];

        } catch (Exception $e) {
            
            $this->pdo->rollBack();
            throw $e;
        }
    }
}