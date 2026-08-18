<?php

class Dette
{

    private ?int $id;
    private float $montant_initial;
    private float $montant_restant;
    private string $statut;
    private array $paiementDettes;
    private DateTime $date_dette;
    private Commande $commande;

    public function __construct(
        Commande $commande,
        float $montant_initial = 0,
        ?int $id = null,
        float $montant_restant = 0,
        string $statut = 'NON SOLDE',
    ) {
        $this->montant_initial = $montant_initial;
        $this->montant_restant = $montant_restant;
        $this->id = $id;
        $this->statut = $statut;
        $this->date_dette = new DateTime();
        $this->commande = $commande;
        $this->paiementDettes = [];
    }


    public function getId(): ?int
    {
        return $this->id;
    }

     public function getMontant_initial(): float
    {
        return $this->montant_initial;
    }

    public function getMontant_restant(): float
    {
        return $this->montant_restant;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function getDateDette(): DateTime
    {
        return $this->date_dette;
    }

    public function getCommande(): Commande
    {
        return $this->commande;
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