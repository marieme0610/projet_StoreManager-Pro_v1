<?php


session_start();
require_once(dirname(__DIR__)."/src/Core/Router.php");
require_once(dirname(__DIR__)."/src/Controller/POSController.php");
require_once(dirname(__DIR__)."/src/Controller/PRDTierController.php");
require_once(dirname(__DIR__)."/src/Model/Repository/ProduitRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/ClientRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/FournisseurRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/CommandeRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/DetteRepository.php");
require_once(dirname(__DIR__)."/src/Model/Repository/LigneCommandeRepository.php");
require_once(dirname(__DIR__)."/src/Service/VenteService.php");


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
    $commandeRepository, 
    $detteRepository,
    $ligneCommandeRepository,
    $venteService

);

$ptiersController = new PRDTierController(
    $clientRepository,
    $produitRepository,
    $fournisseurRepository,
);

$routes = [
    '/'           => ['controller' => $posController, 'action' => 'show'],
    '/showProduitTiers'        => ['controller' => $ptiersController, 'action' => 'show'],
    '/pos/vente'  => ['controller' => $posController, 'action' => 'store'],
];


$router = new Router($routes);
$router->route();