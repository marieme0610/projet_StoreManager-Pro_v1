<?php

class Dette
{
    private ?int $id;
    private float $montant_initial;
    private float $montant_restant;
    private string $statut;
    private ?DateTime $date_dette;
    private int $commande_id;

    public function __construct(
        ?int $id = null,
        float $montant_initial = 0,
        float $montant_restant = 0,
        string $statut = 'NON SOLDE',
        ?string $date_dette = null,
        int $commande_id = 0
    ) {
        $this->id = $id;
        $this->montant_initial = $montant_initial;
        $this->montant_restant = $montant_restant;
        $this->statut = $statut;
        $this->date_dette = $date_dette;
        $this->commande_id = $commande_id;
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

    public function getDate_dette(): ?string
    {
        return $this->date_dette;
    }

    public function getCommande_id(): int
    {
        return $this->commande_id;
    }

    
}