<?php

require_once __DIR__ . '/src/Core/Database.php';

try {

    $db = Database::getInstance();

    echo "Connexion réussie !<br>";

    $pdo = $db->getConnexion();

    echo "Type de base : "
        . $pdo->getAttribute(\PDO::ATTR_DRIVER_NAME);

} catch (\PDOException $e) {

    echo "Erreur : " . $e->getMessage();
}