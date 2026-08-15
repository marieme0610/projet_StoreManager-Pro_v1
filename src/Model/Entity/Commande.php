<?php

class Commande
{
    private ?int $id;
    private ?DateTime $date_commande;
    private float $montant_total;
    private float $montant_paye;
    private bool $est_credit;
    private int $client_id;
    private int $mode_paiement_id;
    private int $utilisateur_id;

    public function __construct(
        ?int $id = null,
        ?string $date_commande = null,
        float $montant_total = 0,
        float $montant_paye = 0,
        bool $est_credit = false,
        int $client_id = 0,
        int $mode_paiement_id = 0,
        int $utilisateur_id = 0
    ) {
        $this->id = $id;
        $this->date_commande = $date_commande;
        $this->montant_total = $montant_total;
        $this->montant_paye = $montant_paye;
        $this->est_credit = $est_credit;
        $this->client_id = $client_id;
        $this->mode_paiement_id = $mode_paiement_id;
        $this->utilisateur_id = $utilisateur_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate_commande(): ?string
    {
        return $this->date_commande;
    }

    public function getMontant_total(): float
    {
        return $this->montant_total;
    }

    public function getMontant_paye(): float
    {
        return $this->montant_paye;
    }

    public function getEst_credit(): bool
    {
        return $this->est_credit;
    }

    public function getClient_id(): int
    {
        return $this->client_id;
    }

    public function getMode_paiement_id(): int
    {
        return $this->mode_paiement_id;
    }

    public function getUtilisateur_id(): int
    {
        return $this->utilisateur_id;
    }

}