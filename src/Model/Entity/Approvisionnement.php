<?php

class Approvisionnement
{
    private ?int $id;
    private string $ref_bl;
    private ?string $date_appro;
    private float $montant_total;
    private int $fournisseur_id;
    private int $statut_appro_id;
    private int $utilisateur_id;

    public function __construct(
        ?int $id = null,
        string $ref_bl = '',
        ?string $date_appro = null,
        float $montant_total = 0,
        int $fournisseur_id = 0,
        int $statut_appro_id = 0,
        int $utilisateur_id = 0
    ) {
        $this->id = $id;
        $this->ref_bl = $ref_bl;
        $this->date_appro = $date_appro;
        $this->montant_total = $montant_total;
        $this->fournisseur_id = $fournisseur_id;
        $this->statut_appro_id = $statut_appro_id;
        $this->utilisateur_id = $utilisateur_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef_bl(): string
    {
        return $this->ref_bl;
    }

    public function getDate_appro(): ?string
    {
        return $this->date_appro;
    }

    public function getMontant_total(): float
    {
        return $this->montant_total;
    }

    public function getFournisseur_id(): int
    {
        return $this->fournisseur_id;
    }

    public function getStatut_appro_id(): int
    {
        return $this->statut_appro_id;
    }

    public function getUtilisateur_id(): int
    {
        return $this->utilisateur_id;
    }
}