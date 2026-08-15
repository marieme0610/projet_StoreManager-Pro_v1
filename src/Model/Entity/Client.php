<?php

class Client
{
    private ?int $id;
    private string $nom;
    private string $prenom;
    private ?string $email;
    private string $tel;
    private float $limite_credit;

   
    public function getId(): ?int {
         return $this->id; 
         }
    public function getNom(): string {
         return $this->nom; 
         }
    public function getPrenom(): string {
         return $this->prenom; 
         }
    public function getEmail(): ?string {
         return $this->email; 
         }
    public function getTel(): string {
         return $this->tel; 
         }
    public function getLimite_credit(): float {
         return $this->limite_credit; 
         }

}