<?php

class LigneCommande
{
    private ?int $id;
    private int $quantite;
    private float $prix_unitaire;
    private int $commande_id;
    private int $produit_id;

    public function getId(): ?int {
         return $this->id; 
    }
    public function getQuantite(): int {
         return $this->quantite; 
    }
    public function getPrix_unitaire(): float {
         return $this->prix_unitaire; 
    }
    public function getCommande_id(): int {
         return $this->commande_id; 
    }
    public function getProduit_id(): int {
         return $this->produit_id; 
    }

}