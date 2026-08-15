<?php

class Approvisionnement
{
    private ?int $id;
    private string $ref_bl;
    private ?string $date_appro;
    private float $montant_total;
    private int $fournisseur_id;
    private int $statut_appro_id;
    private int $utilisateur_id;

    
    public function getId(): ?int {
         return $this->id; 
    }
    public function getRef_bl(): string {
         return $this->ref_bl; 
    }
    public function getDate_appro(): ?string {
         return $this->date_appro; 
    }
    public function getMontant_total(): float {
         return $this->montant_total; 
    }
    public function getFournisseur_id(): int {
         return $this->fournisseur_id; 
    }
    public function getStatut_appro_id(): int {
         return $this->statut_appro_id; 
    }
    public function getUtilisateur_id(): int {
         return $this->utilisateur_id; 
    }

    
}