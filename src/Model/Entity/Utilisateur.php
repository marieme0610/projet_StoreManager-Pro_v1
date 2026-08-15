<?php

class Utilisateur
{
    private ?int $id;
    private string $nom_complet;
    private string $email;
    private string $mot_passe;
    private ?string $tel;
    private int $role_id;

    public function getId(): ?int {
         return $this->id;
          }

    public function getNom_complet(): string {
         return $this->nom_complet;
          }

    public function getEmail(): string {
         return $this->email;
          }

    public function getMot_passe(): string { 
        return $this->mot_passe;
         }

    public function getTel(): ?string { 
        return $this->tel; 
        }

    public function getRole_id(): int {
         return $this->role_id; 
         }

}