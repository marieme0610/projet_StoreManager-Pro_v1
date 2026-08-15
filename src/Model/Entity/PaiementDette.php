<?php

class PaiementDette
{
    private ?int $id;
    private ?string $date_paiement;
    private float $montant;
    private int $dette_id;
    private int $mode_paiement_id;
    private int $utilisateur_id;

   

    public function getId(): ?int {
         return $this->id; 
    }
    public function getDate_paiement(): ?string {
         return $this->date_paiement; 
    }
    public function getMontant(): float {
         return $this->montant; 
    }
    public function getDette_id(): int {
         return $this->dette_id; 
    }
    public function getMode_paiement_id(): int {
         return $this->mode_paiement_id; 
    }
    public function getUtilisateur_id(): int {
         return $this->utilisateur_id; 
    }
}