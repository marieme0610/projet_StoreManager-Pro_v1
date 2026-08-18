<?php

class LigneCommandeRepository{
    private Database $db;
    public function __construct(){
        $this->db = Database::getInstance();
    }
    public function saveLigne(
        array $panier,
        int $commande_id
    ) {
        $sql = "INSERT INTO lignes_commandes (quantite, prix_unitaire, commande_id, produit_id)
                VALUES (:quantite, :prix_unitaire, :commande_id, :produit_id)";

        foreach ($panier as $ligne) {
            $this->db->executeUpdate($sql, [
                'quantite' => $ligne->getQuantite(),
                'prix_unitaire' => $ligne->getPrix_unitaire(),
                'commande_id' => $commande_id,
                'produit_id' => $ligne->getProduit_id()
            ]);
        }
    }

    public function getLigneCommande(int $commandeId = 1): array
    {
        $sql = "SELECT p.libelle, l.prix_unitaire, l.quantite,
                (COALESCE(l.prix_unitaire, 0) * COALESCE(l.quantite, 0)) AS soustotal
                FROM lignes_commandes l
                INNER JOIN produits p ON p.id = l.produit_id
                WHERE l.commande_id = :commande_id";

        return $this->db->executeQuery($sql, ['commande_id' => $commandeId], false);
    }
}