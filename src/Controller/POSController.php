<?php
require_once(dirname(__DIR__)."/Model/Repository/ProduitRepository.php");
require_once(dirname(__DIR__)."/Model/Repository/ClientRepository.php");
require_once(dirname(__DIR__)."/Model/Repository/FournisseurRepository.php");
require_once(dirname(__DIR__)."/Model/Repository/CommandeRepository.php");
require_once(dirname(__DIR__)."/Model/Repository/DetteRepository.php");
require_once(dirname(__DIR__)."/Model/Repository/LigneCommandeRepository.php");
require_once(dirname(__DIR__)."/Service/VenteService.php");
class POSController
{
    private ClientRepository $clientRepository;
    private ProduitRepository $produitRepository;
    private FournisseurRepository $fournisseurRepository;
    private CommandeRepository $commandeRepository;
    private DetteRepository $detteRepository;
    private LigneCommandeRepository $ligneCommandeRepository;
    private VenteService $venteService;

    public function __construct(
        ClientRepository $clientRepository,
        ProduitRepository $produitRepository,
        FournisseurRepository $fournisseurRepository,
        CommandeRepository $commandeRepository,
        DetteRepository $detteRepository,
        LigneCommandeRepository $ligneCommandeRepository,
        VenteService $venteService
    ) {
        $this->clientRepository = $clientRepository;
        $this->produitRepository = $produitRepository;
        $this->fournisseurRepository = $fournisseurRepository;
        $this->commandeRepository = $commandeRepository;
        $this->detteRepository = $detteRepository;
        $this->ligneCommandeRepository = $ligneCommandeRepository;
        $this->venteService = $venteService;
    }

    public function show()
    {
        $commandeActif = $this->commandeRepository->getTotalCommandeEncaisse();
        $nbrCommande = $this->commandeRepository->getNbrCommandeEncaisse();
        $allCommande = $this->commandeRepository->getCommandes();

        $produits = $this->produitRepository->getAllProduits();
        $clients = $this->clientRepository->getAllClients();


        // var_dump($allCommande);

        $ligneCommandes = $this->ligneCommandeRepository->getLigneCommande();

        $detteActif = $this->detteRepository->getTotalDetteActif();
        require_once dirname(__DIR__) . "/View/pos/index.php";
    }
}