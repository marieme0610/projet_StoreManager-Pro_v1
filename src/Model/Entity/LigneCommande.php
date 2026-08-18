<?php

class LigneCommande
{
    private int $quantite;
    private float $prix_unitaire;
    private Commande $commande;
    private Produit $produit;

    public function __construct(
        Commande $commande ,
        Produit $produit,
        int $quantite,
        float $prix_unitaire
    ) {
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
        $this->commande = $commande;
        $this->produit = $produit;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getPrix_unitaire(): float
    {
        return $this->prix_unitaire;
    }

    public function getCommande(): Commande
    {
        return $this->commande;
    }

    public function getProduit(): Produit
    {
        return $this->produit;
    }

}