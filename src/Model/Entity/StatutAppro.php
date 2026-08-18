<?php

class StatutAppro
{
    private ?int $id;
    private string $nom;
    private array $approvisionnements;

    public function __construct(
        string $nom,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->approvisionnements = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getAppro(): array
    {
        return $this->approvisionnements;
    }

    public function addAppro(Approvisionnement $approvisionnement): void
    {
         $this->approvisionnements[] = $approvisionnement;
    }

}