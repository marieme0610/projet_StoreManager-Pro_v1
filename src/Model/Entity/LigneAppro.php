<?php

class LigneAppro
{
    private ?int $id;
    private int $qte_commande;
    private int $qte_recue;
    private float $prix_achat_unitaire;
    private int $approvisionnement_id;
    private int $produit_id;

    public function __construct(
        ?int $id = null,
        int $qte_commande = 0,
        int $qte_recue = 0,
        float $prix_achat_unitaire = 0,
        int $approvisionnement_id = 0,
        int $produit_id = 0
    ) {
        $this->id = $id;
        $this->qte_commande = $qte_commande;
        $this->qte_recue = $qte_recue;
        $this->prix_achat_unitaire = $prix_achat_unitaire;
        $this->approvisionnement_id = $approvisionnement_id;
        $this->produit_id = $produit_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte_commande(): int
    {
        return $this->qte_commande;
    }

    public function getQte_recue(): int
    {
        return $this->qte_recue;
    }

    public function getPrix_achat_unitaire(): float
    {
        return $this->prix_achat_unitaire;
    }

    public function getApprovisionnement_id(): int
    {
        return $this->approvisionnement_id;
    }

    public function getProduit_id(): int
    {
        return $this->produit_id;
    }

}