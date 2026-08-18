<?php

class Client
{
    private string $nom;
    private string $prenom;
    private ?string $email;
    private ?int $id;
    private string $tel;
    private float $limite_credit;
    private array $commandes;

    public function __construct(
        string $nom ,
        string $prenom ,
        string $tel ,
        ?string $email = null,
        ?int $id = null,
        float $limite_credit = 0
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->id = $id;
        $this->email = $email;
        $this->tel = $tel;
        $this->limite_credit = $limite_credit;
        $this->commandes = [];
    }


    public function getId(): ?int
    {
        return $this->id;
    }

     public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getTel(): string
    {
        return $this->tel;
    }

    public function getLimite_credit(): float
    {
        return $this->limite_credit;
    }

    public function getCommandes(): array
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): void
    {
         $this->commandes[]= $commande;
    }

}