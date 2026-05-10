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

INSERT INTO objectif(nom) VALUES
('Augmenter son poids'),
('Reduire son poids'),
('Atteindre IMC ideal');

INSERT INTO users (nom, email, mot_de_passe, genre, date_de_naissance)
VALUES
('Jean', 'jean@gmail.com', '$2y$10$abc123hash', 'Homme', '2000-05-10'),
('Marie', 'marie@gmail.com', '$2y$10$xyz456hash', 'Femme', '1998-11-22');

INSERT INTO sante (user_id, taille, poids)
VALUES
(1, 1.75, 70),
(2, 1.65, 55);