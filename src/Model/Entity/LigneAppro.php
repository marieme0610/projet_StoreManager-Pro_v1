<?php

class LigneAppro
{
    private int $qte_commande;
    private int $qte_recue;
    private float $prix_achat_unitaire;
    private Approvisionnement $approvisionnement;
    private Produit $produit;

    public function __construct(
        Approvisionnement $approvisionnement,
        Produit $produit,
        int $qte_commande,
        float $prix_achat_unitaire,
        int $qte_recue = 0
    ) {
        $this->qte_commande = $qte_commande;
        $this->qte_recue = $qte_recue;
        $this->prix_achat_unitaire = $prix_achat_unitaire;
        $this->approvisionnement = $approvisionnement;
        $this->produit = $produit;
    }


    public function getQteCommande(): int
    {
        return $this->qte_commande;
    }

    public function getQteRecue(): int
    {
        return $this->qte_recue;
    }

    public function getPrixAchatUnitaire(): float
    {
        return $this->prix_achat_unitaire;
    }

    public function getApprovisionnement(): Approvisionnement
    {
        return $this->approvisionnement;
    }

    public function getProduit(): Produit
    {
        return $this->produit;
    }

}