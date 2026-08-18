<?php

class DetteRepository{

   private Database $db;

   public function __construct(){
    $this->db = Database::getInstance();
   }

   public function getAlldetteByIdClient(int $client_id):float{
        $sql = "SELECT COALESCE(SUM(d.montant_restant),0) AS sommeDette
                FROM dettes d INNER JOIN commandes c ON d.commande_id
                = c.id INNER JOIN clients cl ON cl.id = c.client_id
                WHERE cl.id = :client_id";
        $sommeDette = $this->db->executeQuery( $sql, ['client_id'=>$client_id]);
        return $sommeDette['sommeDette'];      
   }

   public function saveDette(
                float $montantTotal,float $montantRestant,int $commande_id
   ):int {
    $sql = "INSERT INTO dettes(montant_initial,montant_restant,commande_id)
                      VALUES(:montant_initial,:montant_restant,:commande_id)";
                      
            $lastIdDette =$this->db->executeUpdate($sql,[
                                'montant_initial'=>$montantTotal,
                                'montant_restant'=>$montantRestant,
                                'commande_id'=>$commande_id
                         ]);
            return $lastIdDette;
   }

   public function getTotalDetteActif(){
        $sql = "SELECT COALESCE(SUM(d.montant_restant),0) AS detteactif FROM dettes d";
        $totalDette = $this->db->executeQuery($sql, []);
        return $totalDette['detteactif'];
   }
}