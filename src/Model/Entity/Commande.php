<?php

class Commande
{
    private DateTime $date_commande;
    private float $montant_total;
    private bool $est_credit;
    private float $montant_paye;    
    private ?int $id;
    private array $dettes;
    private array $ligneCommandes;
    private Client $client;
    private ModePaiement $modePaiement;
    private Utilisateur $utilisateur;

    public function __construct(
        Client $client,
        ModePaiement $modePaiement,
        Utilisateur $utilisateur,
        ?int $id = null,
        float $montant_total = 0,
        float $montant_paye = 0,
        bool $est_credit = false
       
    ) {
        $this->date_commande = new DateTime();
        $this->montant_total = $montant_total;
        $this->id = $id;
        $this->montant_paye = $montant_paye;
        $this->est_credit = $est_credit;
        $this->client = $client;
        $this->modePaiement = $modePaiement;
        $this->utilisateur = $utilisateur;
        $this->dettes = [];
        $this->ligneCommandes = [];
    }



    public function getId(): ?int
    {
        return $this->id;
    }

     public function getDate_commande(): DateTime
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

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getMode_paiement(): ModePaiement
    {
        return $this->mode_paiement;
    }

    public function getUtilisateur(): Utilisateur
    {
        return $this->utilisateur;
    }

    public function getDettes(): array
    {
        return $this->dettes;
    }

    public function addDette(Dette $dette): void
    {
         $this->dettes[] = $dette;
    }

     public function getLignesCommande(): array
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): void
    {
         $this->ligneCommandes[] = $ligneCommande;
    }

}