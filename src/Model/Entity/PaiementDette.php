<?php

class PaiementDette
{
    private DateTime $date_paiement;
    private float $montant;
    private Dette $dette;
    private ModePaiement $mode_paiement;

    public function __construct(
        float $montant,
        Dette $dette,
        ModePaiement $modePaiement
    ) {
        $this->date_paiement = new DateTime();
        $this->montant = $montant;
        $this->dette = $dette;
        $this->mode_paiement = $modePaiement;
    }



    public function getDate_paiement(): DateTime
    {
        return $this->date_paiement;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function getDette(): Dette
    {
        return $this->dette;
    }

    public function getModePaiement(): ModePaiement
    {
        return $this->mode_paiement;
    }

    
}