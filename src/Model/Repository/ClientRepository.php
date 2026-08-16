<?php

require_once(dirname(__DIR__,2)."/src/Core/Database.php");
require_once(dirname(__DIR__) . "/Entity/Client.php");


class ClientRepository
{
   private Database $db;

   public function __construct(){
    $this->db = Database::getInstance();
   }

   public function getAllClient():array{

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

   public function getNbrClient():int{

        $sql = "SELECT COUNT(c.id) AS nbrclient FROM clients c";
        // var_dump($sql);die;

        $datas = $this->db->query($sql);
        return $datas['nbrclient'];
   }

   public function saveClient(Client $newClient):int{
        $sql = "INSERT INTO clients(nom,prenom,email,tel,limite_credit)
                VALUES(:nom,:prenom,:email,:tel,:limite_credit)";

        $result = $this->db->executeUpdate( $sql, [
                'nom'=>$newClient->getNom(),
                'prenom'=>$newClient->getPrenom(),
                'email'=>$newClient->getEmail(),
                'tel'=>$newClient->getTel(),
                'limite_credit'=>$newClient->getLimite_credit()
        ]);
        return $result;     
   }

 



}