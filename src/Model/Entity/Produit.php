<?php

class Produit
{
    private ?int $id;
    private string $libelle;
    private float $prix_vente;
    private int $stock;
    private int $seuil;

    public function getId(): ?int {
         return $this->id; 
         }

    public function getLibelle(): string {
         return $this->libelle;
          }

    public function getPrix_vente(): float {
         return $this->prix_vente; 
         }

    public function getStock(): int {
         return $this->stock;
          }

    public function getSeuil(): int {
         return $this->seuil;
          }



}