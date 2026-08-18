<?php

class Fournisseur
{
    private string $nom;
    private ?string $email;
    private ?int $id;
    private string $tel;
    private ?string $adresse;
    private array $approvisionnements;

    public function __construct(
        string $nom,
        ?string $email,
        string $tel,
        ?string $adresse = null,
        ?int $id = null,
    ) {
        $this->nom = $nom;
        $this->email = $email;
        $this->id = $id;
        $this->tel = $tel;
        $this->approvisionnements = [];
        $this->adresse = $adresse;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

     public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTel(): string
    {
        return $this->tel;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }
    public function getAllAppro(): array
    {
        return $this->approvisionnements;
    }
    public function AddAppro(Approvisionnement $approvisionnement): void
    {
        $this->approvisionnements[] = $approvisionnement;
    }

}