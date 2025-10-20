CREATE DATABASE IF NOT EXISTS bdc;
USE bdc;

CREATE TABLE annee (
    id_annee INT PRIMARY KEY,
    annee INT NOT NULL UNIQUE
);

CREATE TABLE recettes (
    id_recette INT PRIMARY KEY AUTO_INCREMENT,
    categorie VARCHAR(100),            -- Ex: "Impôts", "Douanes", "Recettes non fiscales", "Dons"
    sous_categorie VARCHAR(255),       -- Ex: "TVA", "Impôt sur les revenus", "Dividendes", ...
    montant DECIMAL(15,1) NOT NULL,   -- en milliards d'Ariary, format avec 1 décimale (ex: 4636.5)
    id_annee INT,
    FOREIGN KEY (id_annee) REFERENCES annee(id_annee)
);

CREATE TABLE depenses (
    id_depense INT PRIMARY KEY AUTO_INCREMENT,
    categorie VARCHAR(100),            -- Ex: "Fonctionnement", "Investissement", "Dette"
    sous_categorie VARCHAR(255),       -- Ex: "Intérêts de la dette", "Dépenses de solde", ...
    montant DECIMAL(15,1) NOT NULL,   -- en milliards d'Ariary
    id_annee INT,
    FOREIGN KEY (id_annee) REFERENCES annee(id_annee)
);

CREATE TABLE ministeres (
    id_ministere INT PRIMARY KEY,
    nom VARCHAR(255),
    theme VARCHAR(255)                 -- regroupement haut-niveau (ex: "Social", "Infrastructures", "Defence", ...)
);

CREATE TABLE budget_ministere (
    id_bm INT PRIMARY KEY AUTO_INCREMENT,
    id_ministere INT,
    montant DECIMAL(15,1) NOT NULL,   -- en milliards d'Ariary
    id_annee INT,
    FOREIGN KEY (id_ministere) REFERENCES ministeres(id_ministere),
    FOREIGN KEY (id_annee) REFERENCES annee(id_annee)
);

CREATE TABLE projets (
    id_projet INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    secteur VARCHAR(255),
    localisation VARCHAR(255),
    budget DECIMAL(15,1),             -- agrégat PIP en milliards
    id_annee INT,
    FOREIGN KEY (id_annee) REFERENCES annee(id_annee)
);

-- Insert années
INSERT INTO annee (id_annee, annee) VALUES (1, 2024), (2, 2025);

-- Insert recettes fiscales détaillées (Tableau 3)
-- Les montants sont en milliards d'Ariary (valeurs extraites du PDF)
INSERT INTO recettes (categorie, sous_categorie, montant, id_annee) VALUES
('Impôts','Impôt sur les revenus', 1179.0, 1),
('Impôts','Impôt sur les revenus', 1411.4, 2),

('Impôts','Impôt sur les revenus salariaux et assimilés', 848.2, 1),
('Impôts','Impôt sur les revenus salariaux et assimilés', 889.9, 2),

('Impôts','Impôt sur les revenus des capitaux mobiliers', 78.2, 1),
('Impôts','Impôt sur les revenus des capitaux mobiliers', 93.7, 2),

('Impôts','Impôt sur les plus-values immobilières', 14.0, 1),
('Impôts','Impôt sur les plus-values immobilières', 18.3, 2),

('Impôts','Impôt synthétique', 132.3, 1),
('Impôts','Impôt synthétique', 164.7, 2),

('Impôts','Droit d''enregistrement', 49.0, 1),
('Impôts','Droit d''enregistrement', 62.8, 2),

('Impôts','TVA (y compris TTM)', 1400.2, 1),
('Impôts','TVA (y compris TTM)', 1742.2, 2),

('Impôts','Impôt sur les marchés publics', 148.7, 1),
('Impôts','Impôt sur les marchés publics', 250.0, 2),

('Impôts','Droit d''accise (y compris taxe environnementale)', 754.1, 1),
('Impôts','Droit d''accise (y compris taxe environnementale)', 955.4, 2),

('Impôts','Taxes sur les assurances', 17.2, 1),
('Impôts','Taxes sur les assurances', 20.6, 2),

('Impôts','Droit de timbre', 14.1, 1),
('Impôts','Droit de timbre', 16.8, 2),

('Impôts','Autres', 1.5, 1),
('Impôts','Autres', 2.7, 2);

-- Insert recettes douanières (Tableau 4)
INSERT INTO recettes (categorie, sous_categorie, montant, id_annee) VALUES
('Douanes','Droit de douane', 847.5, 1),
('Douanes','Droit de douane', 1010.7, 2),

('Douanes','TVA à l''importation', 1768.3, 1),
('Douanes','TVA à l''importation', 2148.3, 2),

('Douanes','Taxe sur les produits pétroliers', 308.0, 1),
('Douanes','Taxe sur les produits pétroliers', 326.0, 2),

('Douanes','TVA sur les produits pétroliers', 842.8, 1),
('Douanes','TVA sur les produits pétroliers', 879.0, 2),

('Douanes','Droit de navigation', 1.2, 1),
('Douanes','Droit de navigation', 1.9, 2),

('Douanes','Autres (douanes)', 0.2, 1),
('Douanes','Autres (douanes)', 0.1, 2);

-- Insert recettes non fiscales (Tableau 5)
INSERT INTO recettes (categorie, sous_categorie, montant, id_annee) VALUES
('Recettes non fiscales','Dividendes', 89.5, 1),
('Recettes non fiscales','Dividendes', 120.2, 2),

('Recettes non fiscales','Productions immobilières financières', 0.5, 1),
('Recettes non fiscales','Productions immobilières financières', 2.1, 2),

('Recettes non fiscales','Redevance de pêche', 10.0, 1),
('Recettes non fiscales','Redevance de pêche', 15.0, 2),

('Recettes non fiscales','Redevance minières', 84.9, 1),
('Recettes non fiscales','Redevance minières', 331.2, 2),

('Recettes non fiscales','Autres redevances', 9.7, 1),
('Recettes non fiscales','Autres redevances', 10.0, 2),

('Recettes non fiscales','Produits des activités et autres', 11.1, 1),
('Recettes non fiscales','Produits des activités et autres', 8.1, 2),

('Recettes non fiscales','Autres', 140.1, 1),
('Recettes non fiscales','Autres', 5.2, 2);

-- Insert dons (Tableau 6)
INSERT INTO recettes (categorie, sous_categorie, montant, id_annee) VALUES
('Dons','Courants', 0.3, 1),
('Dons','Courants', 31.0, 2),

('Dons','Capital', 1086.0, 1),
('Dons','Capital', 2445.6, 2);

-- Insert dépenses (Tableau 7 et détails)
INSERT INTO depenses (categorie, sous_categorie, montant, id_annee) VALUES
('Dépenses','Intérêts de la dette', 672.0, 1),
('Dépenses','Intérêts de la dette', 756.5, 2),

('Dépenses','Dépenses courantes de solde (hors indemnités)', 3814.5, 1),
('Dépenses','Dépenses courantes de solde (hors indemnités)', 3846.4, 2),

('Dépenses','Dépenses courantes hors solde', 3069.0, 1),
('Dépenses','Dépenses courantes hors solde', 2304.3, 2),

('Dépenses','Indemnités', 244.8, 1),
('Dépenses','Indemnités', 244.8, 2),

('Dépenses','Biens/Services', 573.2, 1),
('Dépenses','Biens/Services', 504.7, 2),

('Dépenses','Transferts et subventions', 2251.0, 1),
('Dépenses','Transferts et subventions', 1554.8, 2),

('Dépenses','Dépenses d''investissement', 4836.8, 1),
('Dépenses','Dépenses d''investissement', 8537.2, 2),

('Dépenses','PIP sur financement interne', 1262.5, 1),
('Dépenses','PIP sur financement interne', 2377.3, 2),

('Dépenses','PIP sur financement externe', 3574.3, 1),
('Dépenses','PIP sur financement externe', 6159.9, 2),

('Dépenses','Autres opérations nettes du trésor', 390.2, 1),
('Dépenses','Autres opérations nettes du trésor', 860.6, 2),

('Dépenses','TOTAL dépenses publiques', 12782.4, 1),
('Dépenses','TOTAL dépenses publiques', 16304.9, 2);

-- Insert quelques détails additionnels sur dette (données citées)
INSERT INTO depenses (categorie, sous_categorie, montant, id_annee) VALUES
('Dette','Service de la dette - principal (total prévu 2025)', 880.9, 2),
('Dette','Service de la dette - intérêts (total prévu 2025)', 314.2, 2),
('Dette','Intérêts dette intérieure (estimé)', 442.2, 2);

-- Insert ministères (tableau 10) avec id explicite pour faciliter les liens
-- j'ai repris tous les montants 2024 et 2025 présents dans le tableau 10 du PDF
INSERT INTO ministeres (id_ministere, nom, theme) VALUES
(1,'Présidence de la République','Souveraineté'),
(2,'Sénat','Gouvernance'),
(3,'Assemblée Nationale','Gouvernance'),
(4,'Haute Cour Constitutionnelle','Gouvernance'),
(5,'Primature','Gouvernance'),
(6,'Conseil du Fampihavanana Malagasy','Gouvernance'),
(7,'Commission Électorale Nationale Indépendante','Gouvernance'),
(8,'Ministère de la Défense Nationale','Sécurité'),
(9,'Ministère des Affaires Étrangères','Diplomatie'),
(10,'Ministère de la Justice','Justice'),
(11,'Ministère de l''Intérieur','Administration'),
(12,'Ministère de l''Économie et des Finances','Économie'),
(13,'Ministère de la Sécurité Publique','Sécurité'),
(14,'Ministère de l''Industrialisation et du Commerce','Économie'),
(15,'Ministère de la Décentralisation et de l''Aménagement du Territoire','Administration'),
(16,'Ministère du Travail, de l''Emploi et de la Fonction Publique','Social'),
(17,'Ministère du Tourisme et de l''Artisanat','Économie'),
(18,'Ministère de l''Enseignement Supérieur et de la Recherche Scientifique','Éducation'),
(19,'Ministère de l''Environnement et du Développement Durable','Environnement'),
(20,'Ministère de l''Éducation Nationale','Éducation'),
(21,'Ministère des Transports et de la Météorologie','Infrastructures'),
(22,'Ministère de la Santé Publique','Santé'),
(23,'Ministère de la Communication et de la Culture','Culture'),
(24,'Ministère des Travaux Publics','Infrastructures'),
(25,'Ministère des Mines et des Ressources Stratégiques','Ressources'),
(26,'Ministère de l''Énergie et des Hydrocarbures','Énergie'),
(27,'Ministère de l''Eau, de l''Assainissement et de l''Hygiène','Infrastructures'),
(28,'Ministère de l''Agriculture et de l''Élevage','Agriculture'),
(29,'Ministère de la Pêche et de l''Économie Bleue','Agriculture'),
(30,'Ministère de l''Enseignement Technique et de la Formation Professionnelle','Éducation'),
(31,'Ministère de l''Artisanat et des Métiers','Économie'),
(32,'Ministère du Développement Numérique, des Postes et des Télécommunications','Digital'),
(33,'Ministère de la Population et des Solidarités','Social'),
(34,'Ministère de la Jeunesse et des Sports','Social'),
(35,'Secrétariat d''État en charge des Nouvelles Villes et de l''Habitat','Infrastructures'),
(36,'Ministère délégué chargé de la Gendarmerie','Sécurité'),
(37,'Secrétariat d''État en charge de la Souveraineté Alimentaire','Agriculture');

-- Insert budgets ministériels (valeurs LFR 2024 et LF 2025)
-- Format: (id_ministere, montant, id_annee)

-- Présidence, Sénat, Assemblée...
INSERT INTO budget_ministere (id_ministere, montant, id_annee) VALUES
(1,177.1,1),(1,224.7,2),
(2,22.1,1),(2,21.3,2),
(3,87.4,1),(3,85.9,2),
(4,11.9,1),(4,9.3,2),
(5,278.3,1),(5,339.9,2),
(6,6.7,1),(6,6.3,2),
(7,113.3,1),(7,16.4,2),
(8,557.0,1),(8,543.2,2),
(9,99.2,1),(9,104.7,2),
(10,199.6,1),(10,219.8,2),
(11,150.2,1),(11,134.7,2),
(12,2848.0,1),(12,2332.7,2),
(13,228.3,1),(13,229.2,2),
(14,113.2,1),(14,119.6,2),
(15,356.8,1),(15,568.1,2),
(16,31.8,1),(16,33.7,2),
(17,19.2,1),(17,43.9,2),
(18,284.2,1),(18,285.6,2),
(19,94.4,1),(19,188.8,2),
(20,1532.8,1),(20,1562.0,2),
(21,63.9,1),(21,216.3,2),
(22,716.6,1),(22,921.0,2),
(23,38.4,1),(23,32.1,2),
(24,1217.3,1),(24,2327.5,2),
(25,18.3,1),(25,18.1,2),
(26,407.9,1),(26,1332.0,2),
(27,306.1,1),(27,600.2,2),
(28,469.8,1),(28,795.5,2),
(29,29.9,1),(29,28.8,2),
(30,103.7,1),(30,94.8,2),
(31,2.5,1),(31,NULL,2),        -- dans le PDF: 2025 "-" pour ce ministère
(32,8.4,1),(32,8.8,2),
(33,99.1,1),(33,193.4,2),
(34,40.5,1),(34,58.1,2),
(35,247.1,1),(35,138.8,2),
(36,414.8,1),(36,446.4,2),
(37,NULL,1),(37,127.3,2);      -- Secrétariat d'État Souveraineté Alimentaire - présent en 2025 only

-- Insert quelques projets agrégés / PIP (valeurs agrégées du PDF)
INSERT INTO projets (nom, secteur, localisation, budget, id_annee) VALUES
('PIP - financement interne (Agrégé)','Divers', 'National', 1262.5, 1),
('PIP - financement externe (Agrégé)','Divers', 'National', 3574.3, 1),
('PIP - financement interne (Agrégé)','Divers', 'National', 2377.3, 2),
('PIP - financement externe (Agrégé)','Divers', 'National', 6159.9, 2);

