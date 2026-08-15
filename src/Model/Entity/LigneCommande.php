<?php

class LigneCommande
{
    private ?int $id;
    private int $quantite;
    private float $prix_unitaire;
    private int $commande_id;
    private int $produit_id;

    public function __construct(
        ?int $id = null,
        int $quantite = 0,
        float $prix_unitaire = 0,
        int $commande_id = 0,
        int $produit_id = 0
    ) {
        $this->id = $id;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
        $this->commande_id = $commande_id;
        $this->produit_id = $produit_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getPrix_unitaire(): float
    {
        return $this->prix_unitaire;
    }

    public function getCommande_id(): int
    {
        return $this->commande_id;
    }

    public function getProduit_id(): int
    {
        return $this->produit_id;
    }

}