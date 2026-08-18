<?php

class CommandeRepository{
    private Database $db;
    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function saveCommande( 
        float $montantTotal,
        float $avance,
        bool $est_credit,
        int $client_id,
        int $mode_paiement_id,
        int $utilisateur_id
    ):int{
         $sql = "INSERT INTO commandes(
            montant_total,montant_paye,est_credit,client_id,mode_paiement_id,utilisateur_id
            )
            VALUES(
            :montant_total,:montant_paye,
            :est_credit,:client_id,:mode_paiement_id,:utilisateur_id)";

            $lastCommande_id = $this->db->executeUpdate($sql,  
                                        ['montant_total'=>$montantTotal,
                                         'montant_paye'=>$avance,
                                         'est_credit'=>$est_credit,
                                         'client_id'=>$client_id,
                                         'mode_paiement_id'=>$mode_paiement_id,
                                         'utilisateur_id'=>$utilisateur_id
                                        ] );
            return $lastCommande_id;
    }

    public function getTotalCommandeEncaisse():float{
        $sql = "SELECT COALESCE(SUM(montant_paye),0 ) AS totalpaye
                FROM commandes WHERE montant_total = montant_paye;
                ";
        $total = $this->db->executeQuery($sql, []);
        return $total['totalpaye'];
    }

     public function getNbrCommandeEncaisse():int{
        $sql = "SELECT COUNT(id) AS nbrcommande FROM commandes WHERE montant_total = montant_paye";
        $nbrTotal = $this->db->executeQuery($sql, []);
        return $nbrTotal['nbrcommande'];
    }

    public function getCommandes():array{
        $sql = "SELECT c.id, concat('#CMD-',c.id) AS ref, concat(cl.prenom,' ',cl.nom) AS nomcomplet,
                cl.tel,
                c.montant_total ,CASE 
                    WHEN c.montant_paye = montant_total THEN  'COMPTANT (' || mo.libelle || ' )'
                    WHEN c.montant_paye > 0 THEN 'AVANCE (' || mo.libelle || ' )'
                    ELSE  'CREDIT TOTAL'
                END AS reglement
                FROM
                commandes c INNER JOIN clients cl ON c.client_id = cl.id INNER JOIN modes_paiement 
                mo ON mo.id = c.mode_paiement_id GROUP BY cl.id,c.id,mo.id
                ";
        $commandes = $this->db->executeQuery($sql, [],false);

         $sql = "SELECT p.libelle, l.prix_unitaire, l.quantite,
                (COALESCE(l.prix_unitaire,0) * COALESCE(l.quantite,0)) AS soustotal
                FROM lignes_commandes l INNER JOIN produits p ON p.id = l.produit_id
                WHERE l.commande_id = :commande_id";
         foreach ($commandes as &$commande) {
            $commande['lignes'] = $this->db->executeQuery($sql,['commande_id'=>$commande['id']],false);
         }

        return $commandes;
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



   
}