<?php

class Role
{
    private ?int $id;
    private string $nom;
    private array $utilisateurs;

    public function __construct(
        string $nom,
        ?int $id = null
    ) {
        $this->nom = $nom;
        $this->id = $id;
        $this->utilisateurs = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

     public function getNom(): string
    {
        return $this->nom;
    }

     public function getUtilisateurs(): array
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): void
    {
         $this->utilisateurs[]= $utilisateur;
    }

}