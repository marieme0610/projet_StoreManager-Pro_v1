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