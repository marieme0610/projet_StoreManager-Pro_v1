# 📓 Journal de Développement (DEVLOG)
**Nom & Prénom** : [Ndeye Marieme Sarr NDONG]  
**Projet** : StoreManager Pro (ERP PHP/POO)  



### [Vendredi - Phase 1] : Conception & BDD Fallback
- **Heure de réalisation** : 20h
- **Ce qui a été fait** : 
Ce qui a été fait :
J’ai réalisé la modélisation des cas d’utilisation (use cases) pour les différents acteurs du système :

Administrateur Boutique
Chargé de Vente
Chargé de Stock
Inventaire
- **Difficultés / Obstacles** : 
J’ai rencontré quelques difficultés lors de la réalisation des diagrammes de cas d’utilisation. Au début, je pensais que certains acteurs devaient avoir des relations d’héritage entre eux. Après réflexion, j’ai finalement choisi de réaliser un diagramme séparé pour chaque acteur, car cela permet de mieux distinguer les responsabilités et les fonctionnalités propres à chacun.

J’ai également rencontré une difficulté lors de la conception du diagramme de classes. En analysant les écrans fournis, je n’ai pas trouvé de fonctionnalité permettant clairement d’enregistrer un fournisseur. Cela m’a posé quelques difficultés pour déterminer comment le fournisseur devait être représenté dans le modèle et quelles relations il devait avoir avec les autres entités du système. 


### Step 1.2 : Schéma BDD (PostgreSQL & SQLite)

- **Livrables réalisés** : 
  - Fichier SQL PostgreSQL : `docs/schema.sql`
  - Fichier SQL SQLite : `docs/schema_sqlite.sql`
  - Génération du fichier de base de données SQLite : `erp.db`

  - **Difficultés / Obstacles** 
  j'ai rencontré quelques difficultés avec SQL, notamment pour comprendre le lien entre le fichier schema_sqlite.sql et la base de données erp.db.
  J'ai finalement compris que schema_sqlite.sql contient les instructions permettant de créer la structure de la base de données, tandis que erp.db est la base de données SQLite réelle contenant les tables et les données.


### Step 1.3 : Singleton Database & Fallback Automatique

  - **Difficultés / Obstacles** 
J'ai eu des difficultés à comprendre le fonctionnement du Singleton.
J'ai également eu des difficultés à comprendre comment utiliser erp.db comme solution de secours.
J'ai rencontré une erreur lors du test car je faisais appel à une méthode de PDO directement sur Database.
Mais finalement j'ai pue reussir a etablire la connexion que sa soit avec postgres ou sqlite


#### 📌 Step 2.1 (09h00 - 11h00) : Entités POO Pure

- **Livrables réalisés** :
Création des classes Entités correspondant aux différentes tables de la base de données:
    Role -> roles
    Utilisateur -> utilisateurs
    Produit -> produits
    Client -> clients
    Fournisseur -> fournisseurs
    ModePaiement -> modes_paiement
    Commande -> commandes
    LigneCommande -> lignes_commandes
    Dette -> dettes
    PaiementDette -> paiements_dettes
    StatutAppro -> statuts_appro
    Approvisionnement -> approvisionnements
    LigneAppro -> lignes_appros

  - **Difficultés / Obstacles** 
J’ai eu des difficultés à comprendre l’utilité des méthodes dans les classes, puisque les requêtes SQL permettent déjà de récupérer les données. J’ai ensuite compris que les méthodes permettent de manipuler ou d’accéder facilement à des informations spécifiques d’un objet déjà récupéré, sans avoir besoin de retourner systématiquement à la base de données.


## Modification de la base de donnee 

-J'ai regarder a nous mes classe et l'ecran j'ai remarque que il avais des collones qui n'etait pas necessaire comme la datte d'echeance egalement j'ai changer le statut par defaut que j'avais mis en cours car sur l'ecran c'etait SOLDE ou NON SOLDE.
J'avais egalement migres l'id de l'utilsateur dans le paimement_dette ce qui ne sert a rien.
J'ai egalement changer le type des date je les avais mis en TIMESTAMP que j'ai modifier en type DATE .
Du coup vue que j'avais deja creer mes entites de classe j'etais obligé de revenir sur les entites.

-J'ai egalemnt changer le nom du fichier qui tester ma connexion a la base je l"avais appeler index mais vu que c'etait pour tester c'est plus adaquate de l'appeler testConnexion.

-J'ai egalement modifier le nom du dossier qui contenais mes schema de base je l'avais donnee comme nom database je les changer en schemaSql

-Dans le fichier src/Core/Database j'ai couper les fonctionnes de base de donnees que j'avais mis dedans je l'avais fait her mais j'avais pas bien compris raison pour la quelle j'avais mis toutes mes fonctions qui on un rapport a avec la base de donnee puis quand je me suis mieux documenter j'ai appris que ce fichier etait juste pour etablir la connexion et le faire en mode singleton c'est a dire on creer une seul fois la connexion pour durant l'execussion du programme

#### 📌 Step 2.2 (11h00 - 13h00) : Repositories & SQL Sécurisé

- **Livrables réalisés** : 
J'ai pus ecrire les classes des repository Produit client et fournisseur

  - **Difficultés / Obstacles** 
J'ai rencontrer beaucoup de difficulté a travers comment appeller l'instance de la base de donnee que j'avais creer mais aussi comment gerer les fonctions de la database car je les avez elever dans le src/Core/Database.php mais finalement je les remis car si je le remat c'est beaucoup plus simple 
J'ai rencontrer des obstacle a travers le conversions des arrays en object car j'avais mis en premier lieu FETCH_CLASS mais apres je m'etait rendu compte que vous aviez dit que vous n'aimez pas le fetch_class finalement j'ai decider de creer un object du type que je voulais a partir du tableau associatif que m'a renvoie la base donnee apres pour le recuperer j'ai arcuru le tableau en appelant ma fonction qui me creer les elements en mon object voulu 

#### 📌 Step 2.3 (14h00 - 17h00) : Service Métier Vente POS & Transaction SQL

  - **Difficultés / Obstacles** 
D'abord le premier probleme que j'ai eu c'est ce que je pensais que une transaction est seuelement dans les Repository je voyez mal l'utilite de service car je eme disais que toute les information la requette l'amene avec elle 




#### 📌 Step 2.3 Refactoring


j'ai fait la validation du panier et du versement, calcul du reste à payer, contrôle de la limite de crédit du client (somme des dettes existantes + nouveau reste ≤ limite autorisée), vérification du stock disponible produit par produit, puis écriture en base (commande, lignes de commande, dette éventuelle, décrémentation du stock) sous une transaction PDO (beginTransaction/commit/rollback).

  - **Difficultés / Obstacles** 

j'ai encore rencontrer beaucoup de bug mais j'en est beaucoup appris egalemnt quelque obstacle :confusion initiale entre logique métier (Service) et accès aux données (Repository) : mes premières versions faisaient du SQL directement dans le Service, ce qui allait à l'encontre de l'architecture en couches demandée. J'ai dû extraire tout le SQL vers ProduitRepository, ClientRepository, CommandeRepository, DetteRepository, LigneCommandeRepository.
Plusieurs bugs d'inattention lors de la réécriture : variables PHP oubliées sans $ (client_id au lieu de $client_id), mauvaise variable SQL réutilisée par copier-coller ($sql au lieu de $sql1/$sql2), appel d'une méthode de Repository sans passer par l'attribut injecté ($this->getStockProduitId() au lieu de $this->produitRepository->getStockProduitId()).
Erreur de validation qui ne bloquait pas l'exécution : je remplissais un tableau $errors mais je ne testais jamais son contenu avant de continuer.
j'ai appri  l'injection de dépendances : je créais mes Repositories directement avec new à l'intérieur du Service, plutôt que de les recevoir en paramètre du constructeur — ce qui rendait le Service rigide et impossible à faire évoluer sans le modifier.