<?php

class PaiementDette
{
    private ?int $id;
    private ?DateTime $date_paiement;
    private float $montant;
    private int $dette_id;
    private int $mode_paiement_id;

    public function __construct(
        ?int $id = null,
        ?string $date_paiement = null,
        float $montant = 0,
        int $dette_id = 0,
        int $mode_paiement_id = 0
    ) {
        $this->id = $id;
        $this->date_paiement = $date_paiement;
        $this->montant = $montant;
        $this->dette_id = $dette_id;
        $this->mode_paiement_id = $mode_paiement_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate_paiement(): ?string
    {
        return $this->date_paiement;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function getDette_id(): int
    {
        return $this->dette_id;
    }

    public function getMode_paiement_id(): int
    {
        return $this->mode_paiement_id;
    }

    
}