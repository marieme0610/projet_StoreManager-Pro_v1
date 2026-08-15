<?php

class Dette
{
    private ?int $id;
    private float $montant_initial;
    private float $montant_restant;
    private string $statut;
    private ?string $date_echeance;
    private int $commande_id;


    public function getId(): ?int {
         return $this->id; 
    }
    public function getMontant_initial(): float {
         return $this->montant_initial; 
    }
    public function getMontant_restant(): float {
         return $this->montant_restant; 
    }
    public function getStatut(): string {
         return $this->statut; 
    }
    public function getDate_echeance(): ?string {
         return $this->date_echeance; 
    }
    public function getCommande_id(): int {
         return $this->commande_id; 
    }

    
}