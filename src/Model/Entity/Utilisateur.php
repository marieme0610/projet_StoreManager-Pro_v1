<?php

class Utilisateur
{
    private ?int $id;
    private string $nom_complet;
    private string $email;
    private string $mot_passe;
    private string $tel;
    private Role $role;
    private array $commandes;


    public function __construct(
        string $nomComplet,
        string $email,
        string $password,
        string $tel,
        Role $role ,
        ?int $id = null,
    ) {
        $this->id = $id;
        $this->nom_complet = $nomComplet;
        $this->email = $email;
        $this->mot_passe = $password;
        $this->tel = $tel;
        $this->role = $role;
        $this->commandes = [];

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): string
    {
        return $this->nom_complet;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->mot_passe;
    }

    public function getTel(): string
    {
        return $this->tel;
    }

    public function getRole(): Role
    {
        return $this->role;
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