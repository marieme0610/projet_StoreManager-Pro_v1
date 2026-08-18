<?php

require_once(dirname(__DIR__)."/src/Model/Entity/Fournisseur.php");
class Approvisionnement
{
    private string $ref_bl;
    private DateTime $date_appro;
    private float $montant_total;
    private Fournisseur $fournisseur;
    private Statut $statut;
    private Utilisateur $utilisateur;
    private array $ligneAppros;

    public function __construct(
        Fournisseur $fournisseur,
        Statut $statut,
        string $ref_bl,
        Utilisateur $utilisateur,
        float $montant_total
    ) {
        $this->ref_bl = $ref_bl;
        $this->date_appro = new DateTime();
        $this->montant_total = $montant_total;
        $this->fournisseur = $fournisseur;
        $this->statut = $statut;
        $this->utilisateur = $utilisateur;
        $this->ligneAppros = [];
    }


    public function getRef_bl(): string
    {
        return $this->ref_bl;
    }

    public function getDateAppro(): DateTime
    {
        return $this->date_appro;
    }

    public function getMontant_total(): float
    {
        return $this->montant_total;
    }

    public function getFournisseur(): Fournisseur
    {
        return $this->fournisseur;
    }

    public function getStatut(): Statut
    {
        return $this->statut;
    }

    public function getUtilisateur(): Utilisateur
    {
        return $this->utilisateur;
    }
    public function getLignes(): array
    {
        return $this->ligneAppros;
    }

    public function addLignes(LigneAppro $ligneAppro): void
    {
         $this->ligneAppros[] = $ligneAppro;
    }
}