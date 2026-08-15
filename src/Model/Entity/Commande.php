<?php

class Commande
{
    private ?int $id;
    private ?string $date_commande;
    private float $montant_total;
    private float $montant_paye;
    private int $est_credit;
    private int $client_id;
    private int $mode_paiement_id;
    private int $utilisateur_id;


    public function getId(): ?int {
         return $this->id; 
         }
    public function getDate_commande(): ?string {
         return $this->date_commande; 
         }
    public function getMontant_total(): float { 
        return $this->montant_total; 
        }
    public function getMontant_paye(): float {
         return $this->montant_paye; 
         }
    public function getEst_credit(): int {
         return $this->est_credit; 
         }
    public function getClient_id(): int {
         return $this->client_id; 
         }
    public function getMode_paiement_id(): int {
         return $this->mode_paiement_id; 
         }
    public function getUtilisateur_id(): int {
         return $this->utilisateur_id; 
         }

   
}