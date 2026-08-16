<?php


session_start();
require_once(dirname(__DIR__)."/src/Core/Router.php");
require_once(dirname(__DIR__)."/src/Controller/POSController.php");
require_once(dirname(__DIR__)."/src/Model/Repository/ProduitRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/ClientRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/FournisseurRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/CommandeRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/DetteRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/LigneCommandeRepository.php");
require_once(dirname(__DIR__)."/src/Service/VenteService.php");

// -----------------------------------------------------------------
// 1. CÂBLAGE : on crée tous les objets, dans l'ordre de leurs dépendances
//    (un Repository n'a besoin de rien, un Service a besoin de Repositories,
//    un Controller a besoin d'un Service + parfois de Repositories directs)
// -----------------------------------------------------------------
$produitRepository       = new ProduitRepository();
$clientRepository        = new ClientRepository();
$fournisseurRepository   = new FournisseurRepository();
$commandeRepository      = new CommandeRepository();
$detteRepository         = new DetteRepository();
$ligneCommandeRepository = new LigneCommandeRepository();

$venteService = new VenteService(
    $produitRepository,
    $commandeRepository,
    $detteRepository,
    $ligneCommandeRepository
);

$posController = new POSController(
    $clientRepository,
    $produitRepository,
    $fournisseurRepository,
    $venteService

);

// -----------------------------------------------------------------
// 2. DÉCLARATION DES ROUTES
//    Chaque clé = "/uri", chaque valeur = objet déjà construit + action
// -----------------------------------------------------------------
$routes = [
    '/'           => ['controller' => $posController, 'action' => 'show'],
    '/pos'        => ['controller' => $posController, 'action' => 'show'],
    '/pos/vente'  => ['controller' => $posController, 'action' => 'store'],
];

// -----------------------------------------------------------------
// 3. ROUTAGE : le Router choisit et exécute la bonne action
// -----------------------------------------------------------------
$router = new Router($routes);
$router->route();