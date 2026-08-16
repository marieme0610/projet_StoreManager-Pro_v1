<?php
require_once(dirname(__DIR__)."/Model/Repository/ProduitRepository.php");
class POSController
{
    private ClientRepository $clientRepository;
    private ProduitRepository $produitRepository;
    private FournisseurRepository $fournisseurRepository;
    private VenteService $venteService;
    
    public function __construct(
        ClientRepository $clientRepository,
        ProduitRepository $produitRepository,
        FournisseurRepository $fournisseurRepository,
        VenteService $venteService
    ){
        $this->clientRepository = $clientRepository;
        $this->produitRepository = $produitRepository;
        $this->fournisseurRepository = $fournisseurRepository;
        $this->venteService = $venteService;
    }

    public function show()
    {
        $produits = $this->produitRepository->getAllProduits(); 
        // var_dump($produits);

        $clients = $this->clientRepository->getAllClients(); 
        $nbrClient = $this->clientRepository->getNbrClients(); 
        
        $valeurTotalStock = $this->produitRepository->getTotalStock();
        $nbrProduit = $this->produitRepository->getNbrProduit();
        //  var_dump($clients);
        $fournisseurs = $this->fournisseurRepository->getAllFournisseurs();

        if($_SERVER['REQUEST_METHOD']== "POST"){
            if($_POST['btnPOS']=='saveProduit'){
                // var_dump($_POST);
                // die;
                $libelle = $_POST['libelle'] ?? '';
                $stock = $_POST['stock'] ?? 0;
                $prix_vente = $_POST['prix_vente'] ?? 0;
                // var_dump($libelle);
                // die;
                $newProduit = [
                    'libelle'=>$libelle,
                    'stock'=>$stock,
                    'prix_vente'=>$prix_vente
                ];

                $lastIdProduit = $this->produitRepository->saveProduit($newProduit);
                //  var_dump($lastId);
                // die;

            }
            elseif($_POST['btnPOS']=='saveClient'){
               
                // var_dump($_POST);
                // die;
                $nom = $_POST['nom'] ?? '';
                $prenom = $_POST['prenom'] ?? '';
                $email = $_POST['email'] ?? '';
                $tel = $_POST['tel'] ?? '';
                $limite_credit = $_POST['limite_credit'] ?? 0;
                
                $newClient = [
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'email'=>$email,
                    'tel'=>$tel,
                    'limite_credit'=>$limite_credit,
                ];

                $lastIdClient = $this->clientRepository->saveClient($newClient);
            //    var_dump($lastIdClient);
            //    die;
            }
            elseif($_POST['btnPOS']=='saveFournisseur'){
               
                // var_dump($_POST);
                // die;
                $nom = $_POST['nom'] ?? '';
                $adresse = $_POST['adresse'] ?? '';
                $email = $_POST['email'] ?? '';
                $tel = $_POST['tel'] ?? '';
                
                $newFournisseur = [
                    'nom'=>$nom,
                    'adresse'=>$adresse,
                    'email'=>$email,
                    'tel'=>$tel,
                ];
            //     var_dump( $newFournisseur);
            //    die;

                $lastIdFournisseur = $this->fournisseurRepository->saveFournisseur($newFournisseur);
            //    var_dump( $lastIdFournisseur);
            //    die;
            }
        }
        require_once dirname(__DIR__)."/View/pos/index.php";
    }
}