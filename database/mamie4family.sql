-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 août 2025 à 15:20
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de données : `mamie4family`
--

-- --------------------------------------------------------

--
-- Structure de la table `enfants`
--

DROP TABLE IF EXISTS `enfants`;

CREATE TABLE IF NOT EXISTS `enfants` (
    `id_enfant` int NOT NULL AUTO_INCREMENT,
    `id_famille` int NOT NULL,
    `prenom` varchar(100) NOT NULL,
    `age` int NOT NULL,
    `genre` enum ('garçon', 'fille') CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        PRIMARY KEY (`id_enfant`),
        KEY `id_famille` (`id_famille`)
) ENGINE = MyISAM AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enfants`
--

INSERT INTO
    `enfants` (
        `id_enfant`,
        `id_famille`,
        `prenom`,
        `age`,
        `genre`
    )
VALUES (4, 3, 'Alberto', 4, ''),
    (5, 4, 'Laurent', 10, 'garçon'),
    (6, 4, 'Laura', 3, 'fille'),
    (7, 5, 'Rienk', 3, 'garçon');

-- --------------------------------------------------------

--
-- Structure de la table `familles`
--

DROP TABLE IF EXISTS `familles`;

CREATE TABLE IF NOT EXISTS `familles` (
    `id_famille` int NOT NULL AUTO_INCREMENT,
    `prenom` varchar(255) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `nom` varchar(100) NOT NULL,
        `adresse` text CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci,
        `ville` varchar(50) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `telephone` varchar(15) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
        `email` varchar(100) NOT NULL,
        `mot_de_passe` varchar(300) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `photo_profil` varchar(255) DEFAULT NULL,
        `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id_famille`),
        UNIQUE KEY `email` (`email`)
) ENGINE = MyISAM AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `familles`
--

INSERT INTO
    `familles` (
        `id_famille`,
        `prenom`,
        `nom`,
        `adresse`,
        `ville`,
        `telephone`,
        `email`,
        `mot_de_passe`,
        `photo_profil`,
        `date_inscription`
    )
VALUES (
        5,
        'Pierre',
        'Marx',
        '107 BLD REPUBLIQUE',
        'CANNES',
        '0607654433',
        'pierreMarx@g.com',
        '$2y$10$ljcldMUKx6MeiC9xdwMe6.dVSPxyWw6xxy3xtVtZGh9HF8sEb07CO',
        'uploads/profil_67764d40bc721.jpg',
        '2025-01-02 09:24:32'
    ),
    (
        4,
        'Hugues',
        'Alfa',
        '107 BLD REPUBLIQUE',
        'CANNES',
        '0607654433',
        'alfa2312@g.com',
        '$2y$10$o/nejCMVymlOzlaW6D1FyuHiIcg4i.qrV8RlycAnnpnIMTWF2H/WK',
        'uploads/profil_67764c4522fad.jpg',
        '2025-01-02 09:20:21'
    ),
    (
        3,
        'Didier',
        'Durant',
        '107 BLD REPUBLIQUE',
        'CANNES',
        '0607654433',
        'durantdi@g.com',
        '$2y$10$2GVTXWGJNm9B2w7GYOF6tOhOx1w4N1F9wVKGrmH3/fvyvao4qvd4m',
        'uploads/profil_6775483e9d575.png',
        '2025-01-01 14:50:54'
    );

-- --------------------------------------------------------

--
-- Structure de la table `mamies`
--

DROP TABLE IF EXISTS `mamies`;

CREATE TABLE IF NOT EXISTS `mamies` (
    `id_mamie` int NOT NULL AUTO_INCREMENT,
    `prenom` varchar(100) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `nom` varchar(100) NOT NULL,
        `age` int NOT NULL,
        `adresse` text CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci,
        `ville` varchar(50) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
        `telephone` varchar(15) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
        `email` varchar(100) NOT NULL,
        `mot_de_passe` varchar(350) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `tarif_horaire` decimal(10, 2) NOT NULL,
        `competences` text CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci,
        `photo_profil` varchar(255) DEFAULT NULL,
        `photo_piece_identite` varchar(255) DEFAULT NULL,
        `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id_mamie`),
        UNIQUE KEY `email` (`email`)
) ENGINE = MyISAM AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mamies`
--

INSERT INTO
    `mamies` (
        `id_mamie`,
        `prenom`,
        `nom`,
        `age`,
        `adresse`,
        `ville`,
        `telephone`,
        `email`,
        `mot_de_passe`,
        `tarif_horaire`,
        `competences`,
        `photo_profil`,
        `photo_piece_identite`,
        `date_inscription`
    )
VALUES (
        4,
        'Rose',
        'Letti',
        48,
        '107 BLD REPUBLIQUE',
        'CANNES',
        '0493466753',
        'sSSer@gm.com',
        '$2y$10$AYrSMayIesNqGImHULF35eE71kmO2mxsy2yE/OObEXmJXwAiXRtKK',
        20.00,
        'mamie qui aime faire des gâteaux je parle l&#039;anglais et l&#039;espagnol',
        'uploads/profile_677403785e069.png',
        'uploads/idcard_677403785e07a.png',
        '2024-12-31 15:45:12'
    ),
    (
        5,
        'Sylvie',
        'Best',
        60,
        '107 Rue de la République 06400',
        'CANNES',
        '0607654433',
        'sylvie.grattagliano@laplateforme.io',
        '$2y$10$yRRj9vqranNaFCpla0oe/.XMMIfyyeBRaYNvd/NIuUgo78fTZWcZG',
        18.00,
        'garde enfants bas âge, cuisine, devoir, langue parlée espagnol',
        'uploads/profile_677680d8d52da.png',
        'uploads/idcard_677680d8d52ec.jpg',
        '2025-01-02 13:04:40'
    ),
    (
        6,
        'Louise',
        'Dujardin',
        57,
        '107 Rue de la République 06400',
        'CANNES',
        '0607654433',
        'Ddujardin@g.com',
        '$2y$10$.g.qy2GWtUBDhacMGKsGB.JfUqBiiFgv.TfetX.j/g.YUs6NjtDIy',
        17.00,
        'garde enfants? Sortie parc, cuisine, devoir, langue parlée Russe',
        'uploads/profile_677681b73acde.png',
        'uploads/idcard_677681b73aced.jpg',
        '2025-01-02 13:08:23'
    ),
    (
        7,
        'Louise',
        'REVERST',
        57,
        '107 BLD REPUBLIQUE',
        'CANNES',
        '0607654433',
        'louiserevert@g.com',
        '$2y$10$G3WZ5Wlf3VtSQBES2EPQIudrtOEjXd9N18EvSwvhJdQz1jqhAqZ0u',
        17.00,
        'aide aux devoirs, langue parlée Allemand et Anglais',
        NULL,
        NULL,
        '2025-01-02 13:30:00'
    ),
    (
        8,
        'Kat',
        'Nathal',
        56,
        '107 BLD REPUBLIQUE',
        'CANNES',
        '0607654433',
        'snatha@g.com',
        '$2y$10$9ydHVyOzGBGb3NfFx2xbceR1Yj.OQdqTpF6ElIPqLWap8DeQHTGvq',
        16.00,
        'cuisine, et  animation',
        'uploads/profile_6776879e367b1.webp',
        'uploads/idcard_6776879e367bd.jpg',
        '2025-01-02 13:33:34'
    ),
    (
        9,
        'Huguette',
        'LOUIS',
        64,
        '107 BLD REPUBLIQUE',
        'CANNES',
        '0607654433',
        'hugttt@g.com',
        '$2y$10$lwiGmyhHHWgt3Zk7qqEn9e5rsQ4W/qZM6c2FAvgV4/SIaBQRz1hES',
        16.00,
        'aide aux devoirs',
        'uploads/profile_6776939e2a67f.jpg',
        'uploads/idcard_6776939e2a68d.jpg',
        '2025-01-02 14:24:46'
    );

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;

CREATE TABLE IF NOT EXISTS `paiements` (
    `id_paiement` int NOT NULL AUTO_INCREMENT,
    `id_reservation` int NOT NULL,
    `montant_total` decimal(10, 2) NOT NULL,
    `montant_mamie` decimal(10, 2) NOT NULL,
    `commission` decimal(10, 2) NOT NULL,
    `date_paiement` datetime DEFAULT CURRENT_TIMESTAMP,
    `methode_paiement` enum (
        'PayPal',
        'Stripe',
        'Carte bancaire'
    ) NOT NULL,
    PRIMARY KEY (`id_paiement`),
    KEY `id_reservation` (`id_reservation`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE IF NOT EXISTS `reservations` (
    `id_reservation` int NOT NULL AUTO_INCREMENT,
    `id_famille` int NOT NULL,
    `id_mamie` int NOT NULL,
    `date_reservation` datetime DEFAULT CURRENT_TIMESTAMP,
    `date_prestation` date NOT NULL,
    `heure_debut` time NOT NULL,
    `heure_fin` time NOT NULL,
    `tarif_total` decimal(10, 2) NOT NULL,
    `statut` enum (
        'En attente',
        'Confirmée',
        'Terminée'
    ) CHARACTER
    SET
        utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'En attente',
        `facture` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id_reservation`),
        UNIQUE KEY `unique_reservation` (
            `id_mamie`,
            `date_reservation`,
            `heure_debut`,
            `heure_fin`
        ),
        KEY `id_famille` (`id_famille`)
) ENGINE = MyISAM AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO
    `reservations` (
        `id_reservation`,
        `id_famille`,
        `id_mamie`,
        `date_reservation`,
        `date_prestation`,
        `heure_debut`,
        `heure_fin`,
        `tarif_total`,
        `statut`,
        `facture`
    )
VALUES (
        3,
        5,
        4,
        '2025-01-03 00:00:00',
        '0000-00-00',
        '16:00:00',
        '17:59:00',
        0.00,
        'En attente',
        NULL
    ),
    (
        4,
        5,
        5,
        '2025-01-03 00:00:00',
        '0000-00-00',
        '16:40:00',
        '17:41:00',
        0.00,
        'En attente',
        NULL
    );

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;