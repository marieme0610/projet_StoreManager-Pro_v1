<?php

class Produit
{
    private string $libelle;
    private float $prix_vente;
    private int $stock;
    private int $seuil;
    private array $ligneCommandes;
    private ?int $id;

    public function __construct(
        string $libelle,
        float $prix_vente,
        int $seuil,
        int $stock = 0,
        ?int $id = null
    ) {
        $this->libelle = $libelle;
        $this->prix_vente = $prix_vente;
        $this->stock = $stock;
        $this->seuil = $seuil;
        $this->id = $id;
        $this->ligneCommandes = [];
    }


    public function getLibelle(): string
    {
        return $this->libelle;
    }

     public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix_vente(): float
    {
        return $this->prix_vente;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getSeuil(): int
    {
        return $this->seuil;
    }

     public function getLigneCommande(): array
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): void
    {
         $this->ligneCommandes[] = $ligneCommande;
    }

}