# Entité Role

```php
<?php

class Role
{
    private ?int $id;
    private string $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
}
