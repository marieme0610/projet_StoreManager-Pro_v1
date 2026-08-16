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
}