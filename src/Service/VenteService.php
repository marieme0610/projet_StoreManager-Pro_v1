<?php



class VenteService{

    private Database $db;
    private ProduitRepository $produitRepository;
    private CommandeRepository $commandeRepository;
    private DetteRepository $detteRepository;
    private LigneCommandeRepository $ligneCommandeRepository;

    public function __construct(
        ProduitRepository $produitRepository,
        CommandeRepository $commandeRepository,
        DetteRepository $detteRepository,
        LigneCommandeRepository $ligneCommandeRepository
    ){
        $this->db = Database::getInstance();
        $this->produitRepository = $produitRepository;
        $this->commandeRepository = $commandeRepository;
        $this->detteRepository = $detteRepository;
        $this->ligneCommandeRepository = $ligneCommandeRepository;
    }
    public function enregistrerVente(
            int $client_id,float $limit_credit,
             array $panier, float $montantTotal,
             int $mode_paiement_id,float $avance,int $utilisateur_id
    )

    
   {

    $errors = [];


    if(empty($panier)){
        $errors['panier_vide'] = "Vous ne pouvais pas enregistrer un panier vide";
    }
    if($avance < 0){
       $errors['avance_invalide'] =  "Versement invalide";
    }


    $montantRestant = $montantTotal - $avance;
    if ($montantRestant < 0) {
        $montantRestant = 0.0; // le client a versé plus que le total, pas d'erreur bloquante
    }

    if ($montantRestant > 0) {
        $sommeDette = $this->detteRepository->getAlldetteByIdClient($client_id);
        $nouvelleSommeDette = $sommeDette + $montantRestant;

        if($nouvelleSommeDette > $limit_credit){
            $errors['limit_atteint'] = "Vous avez atteint votre limite de credit";
        }
    }

    // Validation du stock pour tous les produits
    foreach ($panier as $ligne) {
        $produit = $this->produitRepository->getStockProduitId($ligne->getProduitId());

        if ($produit === null) {
            $errors['produit_introuvable'] = "Produit #{$ligne->getProduitId()} introuvable.";
            continue;
        }
        if ($ligne->getQuantite() > $produit->getStock()) {
            $errors['stock_insuffisant'] = "Stock insuffisant pour le produit #{$ligne->getProduitId()} (reste {$produit->getStock()}).";
        }
    }

    if (!empty($errors)) {
        throw new InvalidArgumentException(implode(' / ', $errors));
    }

    $est_credit = $montantRestant > 0;  

    $pdo = $this->db->getConnexion();

    $pdo->beginTransaction();

   try {
        
        $commande_id = $this->commandeRepository->saveCommande(
        $montantTotal,$avance,$est_credit,$client_id,$mode_paiement_id,
        $utilisateur_id
    );

        $this->ligneCommandeRepository->saveLigne(
            $panier,$commande_id
        );
        
      

            if($avance < $montantTotal) {

            $detteLastId = $this->detteRepository->saveDette(
                $montantTotal,$montantRestant,$commande_id
            );

            } 

            $this->produitRepository->updateStockProduit($panier);
            

        $pdo->commit();
        return true;
   } 
   catch (\Throwable $th) {
    if($pdo->inTransaction()){
        $pdo->rollback();
    }
     throw $th;
    }  
}
}