PRAGMA foreign_keys = ON;

INSERT INTO roles (id, nom) VALUES
(1, 'Admin'),
(2, 'Vendeur'),
(3, 'Magasinier')
ON CONFLICT(id) DO NOTHING;

INSERT INTO utilisateurs (id, nom_complet, email, mot_passe, tel, role_id) VALUES
(1, 'Admin User', 'admin@store.com', 'admin123', '771234567', 1),
(2, 'Vendeur Test', 'vendeur@store.com', 'vend123', '772345678', 2),
(3, 'Magasin Test', 'magasin@store.com', 'mag123', '773456789', 3)
ON CONFLICT(id) DO NOTHING;

INSERT INTO produits (id, libelle, prix_vente, stock_actuel, seuil_alerte) VALUES
(1, 'Café Premium', 5000.00, 50, 10),
(2, 'Sucre Cristal', 1500.00, 100, 20),
(3, 'Thé Vert', 3000.00, 30, 5),
(4, 'Lait Concentré', 2500.00, 45, 15),
(5, 'Pain de Mie', 3500.00, 60, 25),
(6, 'Beurre 250g', 4500.00, 20, 8),
(7, 'Farine 1kg', 2000.00, 75, 30),
(8, 'Huile Végétale', 6000.00, 40, 12),
(9, 'Sel 500g', 800.00, 120, 50),
(10, 'Sucre Roux', 1800.00, 80, 15)
ON CONFLICT(id) DO NOTHING;

INSERT INTO clients (id, nom, prenom, email, tel, limite_credit) VALUES
(1, 'Diop', 'Aminata', 'aminata.diop@mail.com', '771111111', 50000.00),
(2, 'Ndiaye', 'Moussa', 'moussa.ndiaye@mail.com', '772222222', 75000.00),
(3, 'Sarr', 'Fatoumata', 'fatoumata.sarr@mail.com', '773333333', 100000.00),
(4, 'Ly', 'Ousmane', 'ousmane.ly@mail.com', '774444444', 60000.00),
(5, 'Ba', 'Khadidja', 'khadidja.ba@mail.com', '775555555', 80000.00)
ON CONFLICT(id) DO NOTHING;

INSERT INTO fournisseurs (id, nom, email, tel, adresse) VALUES
(1, 'Fournisseur Dakar', 'contact@fdakar.com', '339001111', 'Plateau, Dakar'),
(2, 'Import Export Sénégal', 'ventes@ies.sn', '339002222', 'Hann Mariste, Dakar'),
(3, 'Grossiste Kaolack', NULL, '339003333', 'Kaolack'),
(4, 'Distribution Nationale', 'info@distnational.sn', '339004444', 'Thiès')
ON CONFLICT(id) DO NOTHING;

INSERT INTO modes_paiement (id, libelle) VALUES
(1, 'Espèces'),
(2, 'Carte Bancaire'),
(3, 'Virement'),
(4, 'Chèque')
ON CONFLICT(id) DO NOTHING;

INSERT INTO commandes (id, date_commande, montant_total, montant_paye, est_credit, client_id, mode_paiement_id, utilisateur_id) VALUES
(1, '2026-08-10', 18000.00, 18000.00, false, 1, 1, 2),
(2, '2026-08-12', 14000.00, 5000.00, true, 2, 2, 2),
(3, '2026-08-13', 14000.00, 14000.00, false, 3, 3, 1)
ON CONFLICT(id) DO NOTHING;

INSERT INTO lignes_commandes (id, quantite, prix_unitaire, commande_id, produit_id) VALUES
(1, 2, 5000.00, 1, 1),
(2, 3, 1500.00, 1, 2),
(3, 1, 3500.00, 1, 5),
(4, 1, 6000.00, 2, 8),
(5, 2, 2500.00, 2, 4),
(6, 1, 3000.00, 2, 3),
(7, 2, 3500.00, 3, 5),
(8, 2, 2000.00, 3, 7),
(9, 1, 3000.00, 3, 3)
ON CONFLICT(id) DO NOTHING;

INSERT INTO dettes (id, montant_initial, montant_restant, statut,  commande_id) VALUES
(1, 14000.00, 9000.00, 'EN_COURS', 2)
ON CONFLICT(id) DO NOTHING;

INSERT INTO paiements_dettes (id, date_paiement, montant, dette_id, mode_paiement_id) VALUES
(1, '2026-08-13', 5000.00, 1, 2)
ON CONFLICT(id) DO NOTHING;
