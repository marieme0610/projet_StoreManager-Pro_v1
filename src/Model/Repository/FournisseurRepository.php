<?php

require_once(dirname(__DIR__, 2) . "/Core/Database.php");
require_once(dirname(__DIR__) . "/Entity/Fournisseur.php");

class FournisseurRepository
{
   
    private Database $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function getAllFournisseurs():array{
        $sql = "SELECT * FROM fournisseurs";

        $query = $this->db->executeQuery( $sql, [], false);
        $fournisseurs = [];
        
        foreach ($query as  $fournisseur) {
            $fournisseurs[]= $this->conversionEnObjet($fournisseur);
        }
        return $fournisseurs;

    }

    private function conversionEnObjet(array $query):Fournisseur{
        return new Fournisseur(
            $query['id'],
            $query['nom'],
            $query['tel'],
            $query['adresse'],
            $query['email']
        );
    }

    public function saveFournisseur(array $fournisseur):int{

        $sql = "INSERT INTO fournisseurs(nom,email,tel,adresse)
                VALUES(:nom,:email,:tel,:adresse)";

        $result = $this->db->executeUpdate($sql, [
            'nom'=>$fournisseur['nom'],
            'email'=>$fournisseur['email'],
            'tel'=>$fournisseur['tel'],
            'adresse'=>$fournisseur['adresse']
        ]);
        return $result;
    }

}