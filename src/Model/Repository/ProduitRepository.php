<?php

require_once(dirname(__DIR__, 2) . "/Core/Database.php");
require_once(dirname(__DIR__) . "/Entity/Produit.php");

class ProduitRepository
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAllProduit(): array
    {
        $sql = "SELECT id, libelle, prix_vente, stock, seuil FROM produits";
        $query = $this->db->query($sql, false); 
        $produits = [];
        foreach ($query as $produit) {
            $produits[] = $this->convertEnProduit($produit);
        }

        return $produits;
    }

    public function saveProduit(Produit $newProduit): int
    {
        $sql = "
            INSERT INTO produits (libelle, prix_vente, stock, seuil)
            VALUES (:libelle, :prix_vente, :stock, :seuil)
        ";

        return $this->db->executeUpdate($sql, [
            'libelle'    => $newProduit->getLibelle(),
            'prix_vente' => $newProduit->getPrixVente(),
            'stock'      => $newProduit->getStock(),
            'seuil'      => $newProduit->getSeuil()
        ]);
    }

 
    private function convertEnProduit(array $produits): Produit
    {
        return new Produit(
            (int) $produits['id'],
            $produits['libelle'],
            (float) $produits['prix_vente'],
            (int) $produits['stock'],
            (int) $produits['seuil']
        );
    }

    public function getTotalStock():float{
        $sql = "SELECT SUM(
                COALESCE(p.prix_vente, 0) * COALESCE(p.stock, 0)
                ) AS totalValeurStock
                FROM produits p";

        $datas = $this->db->query($sql);
        return $datas['totalValeurStock'];
    }

    public function getNbrProduit():int{

        $sql = "SELECT COUNT(p.id) AS nbrproduit FROM produits p";
        $datas = $this->db->query($sql);
        return $datas['nbrproduit'];
    }

    public function getProduitRuptur():array{
 
        $sql = "SELECT * FROM produits WHERE stock <= seuil";
        $query = $this->db->executeQuery( $sql, [], false);
        $produitEnRupture = [];
        foreach ($query as  $produit) {
            $produitEnRupture[] = $this->convertEnProduit($produit);
        }
        return $produitEnRupture;
    }
}