<?php

class Fournisseur
{
    private ?int $id;
    private string $nom;
    private ?string $email;
    private string $tel;
    private ?string $adresse;


    public function getId(): ?int {
         return $this->id; 
         }
    public function getNom(): string {
         return $this->nom; 
         }
    public function getEmail(): ?string {
         return $this->email; 
         }
    public function getTel(): string {
         return $this->tel; 
         }
    public function getAdresse(): ?string {
         return $this->adresse; 
         }

    
}