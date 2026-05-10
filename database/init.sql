DROP DATABASE IF EXISTS Alimentaire;
CREATE DATABASE IF NOT EXISTS Alimentaire;
USE Alimentaire;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    genre VARCHAR(10),
    porte_monnaie DECIMAL(10,2) DEFAULT 0,
    is_gold BOOLEAN DEFAULT FALSE,
    date_de_naissance DATE,
    role ENUM('USER','ADMIN') DEFAULT 'USER'
) ENGINE=InnoDB;

CREATE TABLE sante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    taille DECIMAL(5,2),
    poids DECIMAL(5,2),
    imc DECIMAL(5,2),
    CONSTRAINT fk_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE objectif(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE user_objectif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    objectif_id INT NOT NULL,
    date_choix TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (objectif_id)
        REFERENCES objectif(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE regimes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    duree_jour INT NOT NULL,
    variation_poids DECIMAL(5,2), 
    -- positif = gain
    -- negatif = perte
    pourcentage_viande DECIMAL(5,2),
    pourcentage_poisson DECIMAL(5,2),
    pourcentage_volaille DECIMAL(5,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
) ENGINE=InnoDB;

CREATE TABLE activites_sportives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    calories_brulees INT,
    duree_minute INT
) ENGINE=InnoDB;

CREATE TABLE regime_sport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regime_id INT NOT NULL,
    sport_id INT NOT NULL,
    FOREIGN KEY (regime_id)
        REFERENCES regimes(id)
        ON DELETE CASCADE,
    FOREIGN KEY (sport_id)
        REFERENCES activites_sportives(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE user_regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    regime_id INT NOT NULL,
    date_debut DATE,
    date_fin DATE,
    prix_total DECIMAL(10,2),
    statut ENUM('EN_COURS','TERMINE') DEFAULT 'EN_COURS',
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (regime_id)
        REFERENCES regimes(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE codes_portefeuille (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100) UNIQUE NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    utilise BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB;

CREATE TABLE recharge_portefeuille (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    code_id INT NOT NULL,
    date_recharge TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (code_id)
        REFERENCES codes_portefeuille(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE abonnement_gold (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    date_paiement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;


-- =====================================================
-- INSERTION DES DONNÉES DE TEST
-- Projet Alimentaire - Régimes et objectifs
-- =====================================================

-- 1. INSERTION DES OBJECTIFS (déjà existants)
INSERT INTO objectif(nom) VALUES
('Augmenter son poids'),
('Reduire son poids'),
('Atteindre IMC ideal');

-- 2. INSERTION DES UTILISATEURS (5 utilisateurs)
INSERT INTO users (nom, email, mot_de_passe, genre, porte_monnaie, is_gold, date_de_naissance, role) VALUES
('Jean Dupont', 'jean.dupont@gmail.com', '$2y$10$YourHashedPasswordHere1', 'Homme', 150.00, FALSE, '1990-05-15', 'USER'), -- password: password123
('Marie Martin', 'marie.martin@gmail.com', '$2y$10$YourHashedPasswordHere2', 'Femme', 250.50, TRUE, '1988-12-20', 'USER'),
('Pierre Durand', 'pierre.durand@gmail.com', '$2y$10$YourHashedPasswordHere3', 'Homme', 75.30, FALSE, '1995-03-10', 'USER'),
('Sophie Bernard', 'sophie.bernard@gmail.com', '$2y$10$YourHashedPasswordHere4', 'Femme', 320.00, TRUE, '1992-07-25', 'USER'),
('Admin System', 'admin@alimentaire.com', '$2y$10$AdminHashHere', 'Homme', 0.00, FALSE, '1985-01-01', 'ADMIN');

-- 3. INSERTION DES DONNÉES DE SANTÉ
INSERT INTO sante (user_id, taille, poids, imc) VALUES
(1, 1.75, 85.5, 27.92),  -- Jean - Surpoids
(2, 1.65, 52.0, 19.10),  -- Marie - Poids normal
(3, 1.80, 95.0, 29.32),  -- Pierre - Surpoids
(4, 1.70, 48.0, 16.61),  -- Sophie - Maigreur
(5, 1.72, 70.0, 23.66);  -- Admin - Poids normal

-- 4. INSERTION DES OBJECTIFS UTILISATEURS
INSERT INTO user_objectif (user_id, objectif_id, date_choix) VALUES
(1, 2, '2026-05-01 10:00:00'),  -- Jean veut réduire son poids
(2, 3, '2026-05-02 14:30:00'),  -- Marie veut IMC idéal
(3, 2, '2026-05-03 09:15:00'),  -- Pierre veut réduire son poids
(4, 1, '2026-05-04 16:45:00'),  -- Sophie veut augmenter son poids
(5, 3, '2026-05-05 11:20:00');  -- Admin veut IMC idéal

-- 5. INSERTION DES ACTIVITÉS SPORTIVES (5 activités)
INSERT INTO activites_sportives (nom, description, calories_brulees, duree_minute) VALUES
('Marche rapide', 'Marche à allure soutenue, idéale pour débuter', 250, 60),
('Course à pied', 'Running à intensité modérée', 500, 45),
('Natation', 'Nage crawl ou brasse', 400, 45),
('Vélo', 'Cyclisme à allure modérée', 350, 60),
('Musculation', 'Séance complète avec poids', 300, 50);

-- 6. INSERTION DES RÉGIMES (5 régimes)
INSERT INTO regimes (nom, description, prix, duree_jour, variation_poids, pourcentage_viande, pourcentage_poisson, pourcentage_volaille) VALUES
('Régime Protéiné', 'Régime riche en protéines pour prise de muscle', 199.99, 30, 3.50, 40.00, 30.00, 30.00),
('Régime Hypocalorique', 'Pour perdre du poids efficacement', 149.99, 21, -5.00, 25.00, 35.00, 40.00),
('Régime Équilibré', 'Alimentation saine et variée', 99.99, 14, 0.00, 33.33, 33.33, 33.34),
('Régime Prise de Masse', 'Pour augmenter sa masse musculaire', 249.99, 45, 5.50, 45.00, 25.00, 30.00),
('Régime Détox', 'Purification et nettoyage du corps', 79.99, 7, -2.00, 20.00, 40.00, 40.00);

-- 7. ASSOCIATION RÉGIMES - ACTIVITÉS SPORTIVES
INSERT INTO regime_sport (regime_id, sport_id) VALUES
(1, 5),  -- Régime Protéiné + Musculation
(1, 2),  -- Régime Protéiné + Course
(2, 1),  -- Régime Hypocalorique + Marche
(2, 3),  -- Régime Hypocalorique + Natation
(3, 1),  -- Régime Équilibré + Marche
(3, 4),  -- Régime Équilibré + Vélo
(4, 5),  -- Régime Prise de Masse + Musculation
(4, 2),  -- Régime Prise de Masse + Course
(5, 3),  -- Régime Détox + Natation
(5, 1);  -- Régime Détox + Marche

-- 8. INSERTION DES CODES PORTE-MONNAIE (15 codes)
INSERT INTO codes_portefeuille (code, montant, utilise) VALUES
('GIFT2024-001', 50.00, FALSE),
('GIFT2024-002', 100.00, FALSE),
('GIFT2024-003', 25.00, FALSE),
('WELCOME10', 10.00, FALSE),
('PROMO50', 50.00, FALSE),
('SALE2024', 75.00, FALSE),
('GOLD2024', 200.00, FALSE),
('NEWUSER', 20.00, FALSE),
('REFERRAL', 30.00, FALSE),
('BIRTHDAY', 15.00, FALSE),
('SPECIAL99', 99.99, FALSE),
('HALFOFF', 45.00, FALSE),
('LOYALTY', 40.00, FALSE),
('SPRING25', 25.00, FALSE),
('SUMMER24', 60.00, FALSE);

-- 9. INSERTION DES RECHARGES PORTE-MONNAIE
INSERT INTO recharge_portefeuille (user_id, code_id, date_recharge) VALUES
(1, 1, '2026-05-01 08:30:00'),
(2, 2, '2026-05-02 10:15:00'),
(2, 4, '2026-05-03 14:20:00'),
(3, 3, '2026-05-04 09:45:00'),
(4, 5, '2026-05-05 16:00:00'),
(1, 6, '2026-05-06 11:30:00'),
(4, 7, '2026-05-07 13:15:00');

-- 10. INSERTION DES ABONNEMENTS GOLD
INSERT INTO abonnement_gold (user_id, montant, date_paiement) VALUES
(2, 49.99, '2026-05-02 10:00:00'),
(4, 49.99, '2026-05-05 09:30:00');

-- 11. INSERTION DES RÉGIMES UTILISATEURS
INSERT INTO user_regime (user_id, regime_id, date_debut, date_fin, prix_total, statut) VALUES
(1, 2, '2026-05-01', '2026-05-22', 149.99, 'EN_COURS'),
(2, 3, '2026-05-03', '2026-05-17', 84.99, 'EN_COURS'),  -- Gold : 99.99 - 15%
(3, 5, '2026-05-04', '2026-05-11', 79.99, 'EN_COURS'),
(4, 1, '2026-05-02', '2026-06-01', 169.99, 'EN_COURS'),  -- Gold : 199.99 - 15%
(2, 4, '2026-04-01', '2026-05-16', 212.49, 'TERMINE'),    -- Gold : 249.99 - 15%
(1, 3, '2026-04-10', '2026-04-24', 99.99, 'TERMINE');
