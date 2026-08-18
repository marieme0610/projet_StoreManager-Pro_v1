<?php

class ModePaiement
{
    private ?int $id;
    private string $libelle;
    private array $commandes;
    private array $paiementDettes;


    public function __construct(
        string $libelle,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->commandes = [];
        $this->paiementDettes = [];

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

     public function getCommandes(): array
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): void
    {
         $this->commandes[]= $commande;
    }

     public function getPaiementDettes(): array
    {
        return $this->paiementDettes;
    }
    public function addPaiementDette(PaiementDette $paiementDette): void
    {
        $this->paiementDettes[] = $paiementDette;
    }
}