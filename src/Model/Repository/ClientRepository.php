<?php

require_once(dirname(__DIR__,2)."/Core/Database.php");
require_once(dirname(__DIR__) . "/Entity/Client.php");


class ClientRepository
{
   private Database $db;

   public function __construct(){
    $this->db = Database::getInstance();
   }

   public function getAllClients():array{

      $sql = "SELECT * FROM clients" ;

    //   var_dump($sql);

      $datas = $this->db->executeQuery( $sql, [], false);

      $clients = [];

      foreach ($datas as $data) {
        $clients[] = $this->convertToclient($data);
      }

    //   var_dump($clients);
  
    return $clients;
   }

   private function convertToclient(array $datas):Client{
        return new Client(
            (int)$datas['id'],
            $datas['prenom'],
            $datas['nom'],
            $datas['tel'],
            $datas['email'],
            $datas['limite_credit']
        );
   }

   public function getNbrClients():int{

        $sql = "SELECT COUNT(c.id) AS nbrclient FROM clients c";
        // var_dump($sql);die;

        $datas = $this->db->query($sql);
        return $datas['nbrclient'];
   }

   public function saveClient(array $newClient):int{
        $sql = "INSERT INTO clients(nom,prenom,email,tel,limite_credit)
                VALUES(:nom,:prenom,:email,:tel,:limite_credit)";

        $result = $this->db->executeUpdate( $sql, [
                'nom'=>$newClient['nom'],
                'prenom'=>$newClient['prenom'],
                'email'=>$newClient['email'],
                'tel'=>$newClient['tel'],
                'limite_credit'=>$newClient['limite_credit']
        ]);
        return $result;     
   }
   

 



}