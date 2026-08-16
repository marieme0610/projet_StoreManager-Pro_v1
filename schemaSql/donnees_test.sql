-- Insertion des rôles
INSERT INTO roles (nom) VALUES ('Admin');
INSERT INTO roles (nom) VALUES ('Vendeur');
INSERT INTO roles (nom) VALUES ('Magasinier');

-- Insertion des utilisateurs
INSERT INTO utilisateurs (nom_complet, email, mot_passe, tel, role_id) VALUES 
('Admin User', 'admin@store.com', 'admin123', '771234567', 1),
('Vendeur Test', 'vendeur@store.com', 'vend123', '772345678', 2),
('Magasin Test', 'magasin@store.com', 'mag123', '773456789', 3);

-- Insertion des produits
INSERT INTO produits (libelle, prix_vente, stock, seuil) VALUES 
('Café Premium', 5000, 50, 10),
('Sucre Cristal', 1500, 100, 20),
('Thé Vert', 3000, 30, 5),
('Lait Concentré', 2500, 45, 15),
('Pain de Mie', 3500, 60, 25),
('Beurre 250g', 4500, 20, 8),
('Farine 1kg', 2000, 75, 30),
('Huile Végétale', 6000, 40, 12),
('Sel 500g', 800, 120, 50),
('Sucre Roux', 1800, 80, 15);

-- Insertion des clients
INSERT INTO clients (nom, prenom, email, tel, limite_credit) VALUES 
('Diop', 'Aminata', 'aminata.diop@mail.com', '771111111', 50000),
('Ndiaye', 'Moussa', 'moussa.ndiaye@mail.com', '772222222', 75000),
('Sarr', 'Fatoumata', 'fatoumata.sarr@mail.com', '773333333', 100000),
('Ly', 'Ousmane', 'ousmane.ly@mail.com', '774444444', 60000),
('Ba', 'Khadidja', 'khadidja.ba@mail.com', '775555555', 80000);

-- Insertion des fournisseurs
INSERT INTO fournisseurs (nom, email, tel, adresse) VALUES 
('Fournisseur Dakar', 'contact@fdakar.com', '339001111', 'Plateau, Dakar'),
('Import Export Sénégal', 'ventes@ies.sn', '339002222', 'Hann Mariste, Dakar'),
('Grossiste Kaolack', NULL, '339003333', 'Kaolack'),
('Distribution Nationale', 'info@distnational.sn', '339004444', 'Thiès');

-- Insertion des modes de paiement
INSERT INTO modes_paiement (libelle) VALUES 
('Espèces'),
('Carte Bancaire'),
('Virement'),
('Chèque');
