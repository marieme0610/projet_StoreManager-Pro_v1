<?php

class LigneCommandeRepository{
    private Database $db;
    public function __construct(){
        $this->db = Database::getInstance();
    }
    public function saveLigne(
        array $panier,int $commande_id
    ){
        $sql = "INSERT INTO ligneCommande(quantite,prix_unitaire,commande_id,produit_id)
                    VALUES(:quantite,:prix_unitaire,:commande_id,:produit_id)";

                    foreach ($panier as  $ligne) {
                        
                        $this->db->executeUpdate($sql, [
                                'quantite'=>$ligne->getQuantite(),
                                'prix_unitaire'=>$ligne->getPrix_unitaire(),
                                'commande_id'=>$commande_id,
                                'produit_id'=>$ligne->getProduit_id()
                        ]);
                    }
    }
    }