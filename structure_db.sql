-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 19 mars 2024 à 20:24
-- Version du serveur : 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mydatabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

DROP TABLE IF EXISTS `Categorie`;
CREATE TABLE `Categorie` (
  `id_categorie` int(10) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description_cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Categorie_Livre`
--

DROP TABLE IF EXISTS `Categorie_Livre`;
CREATE TABLE `Categorie_Livre` (
  `isbn_livre` bigint(30) NOT NULL,
  `id_categorie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Critique`
--

DROP TABLE IF EXISTS `Critique`;
CREATE TABLE `Critique` (
  `id_critique` int(10) NOT NULL,
  `etoiles` int(1) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `est_signale` varchar(3) NOT NULL,
  `id_client` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Demande`
--

DROP TABLE IF EXISTS `Demande`;
CREATE TABLE `Demande` (
  `id` int(10) NOT NULL,
  `type_demande` varchar(20) NOT NULL,
  `date_demande` date NOT NULL,
  `id_auteur` int(10) NOT NULL,
  `isbn_livre` bigint(30) NOT NULL,
  `employe_matricule` varchar(12) NOT NULL,
  `id_critique` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Employe`
--

DROP TABLE IF EXISTS `Employe`;
CREATE TABLE `Employe` (
  `id` varchar(12) NOT NULL,
  `username_usager` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Emprunt`
--

DROP TABLE IF EXISTS `Emprunt`;
CREATE TABLE `Emprunt` (
  `id` int(10) NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date NOT NULL,
  `id_client` int(10) DEFAULT NULL,
  `id_copie` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

DROP TABLE IF EXISTS `Client`;
CREATE TABLE `Client` (
  `id` int(10) NOT NULL,
  `est_abonne` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Copie`
--

DROP TABLE IF EXISTS `Copie`;
CREATE TABLE `Copie` (
  `id_copie` int(10) NOT NULL,
  `est_dispo` tinyint(1) NOT NULL,
  `isbn_livre` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Genre_Livre`
--

DROP TABLE IF EXISTS `Genre_Livre`;
CREATE TABLE `Genre_Livre` (
  `isbn_livre` bigint(30) NOT NULL,
  `id_genre` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Genre`
--

DROP TABLE IF EXISTS `Genre`;
CREATE TABLE `Genre` (
  `id_genre` int(10) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Livre`
--

DROP TABLE IF EXISTS `Livre`;
CREATE TABLE `Livre` (
  `isbn` bigint(30) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `maison_edition` varchar(30) DEFAULT NULL,
  `annee` int(4) DEFAULT NULL,
  `url_image` text NOT NULL,
  `description_livre` text DEFAULT NULL,
  `id_auteur` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Auteur`
--

DROP TABLE IF EXISTS `Auteur`;
CREATE TABLE `Auteur` (
  `id` int(10) NOT NULL,
  `username_usager` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

DROP TABLE IF EXISTS `Reservation`;
CREATE TABLE `Reservation` (
  `id_reservation` int(10) NOT NULL,
  `date_demande` date NOT NULL,
  `id_client` int(10) NOT NULL,
  `isbn_livre` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Usager`
--

DROP TABLE IF EXISTS `Usager`;
CREATE TABLE `Usager` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `courriel` varchar(50) DEFAULT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Auteur`
--
ALTER TABLE `Auteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_usager` (`username_usager`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `Categorie_Livre`
--
ALTER TABLE `Categorie_Livre`
  ADD PRIMARY KEY (`isbn_livre`,`id_categorie`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Copie`
--
ALTER TABLE `Copie`
  ADD PRIMARY KEY (`id_copie`),
  ADD KEY `isbn_livre` (`isbn_livre`);

--
-- Index pour la table `Critique`
--
ALTER TABLE `Critique`
  ADD PRIMARY KEY (`id_critique`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `Demande`
--
ALTER TABLE `Demande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auteur` (`id_auteur`),
  ADD KEY `isbn_livre` (`isbn_livre`),
  ADD KEY `employe_matricule` (`employe_matricule`),
  ADD KEY `id_critique` (`id_critique`);

--
-- Index pour la table `Employe`
--
ALTER TABLE `Employe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_usager` (`username_usager`);

--
-- Index pour la table `Emprunt`
--
ALTER TABLE `Emprunt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_copie` (`id_copie`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Index pour la table `Genre_Livre`
--
ALTER TABLE `Genre_Livre`
  ADD PRIMARY KEY (`isbn_livre`,`id_genre`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Index pour la table `Livre`
--
ALTER TABLE `Livre`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `id_auteur` (`id_auteur`);

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `isbn_livre` (`isbn_livre`);

--
-- Index pour la table `Usager`
--
ALTER TABLE `Usager`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Auteur`
--
ALTER TABLE `Auteur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `id_categorie` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Copie`
--
ALTER TABLE `Copie`
  MODIFY `id_copie` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Emprunt`
--
ALTER TABLE `Emprunt`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Auteur`
--
ALTER TABLE `Auteur`
  ADD CONSTRAINT `Auteur_ibfk_1` FOREIGN KEY (`username_usager`) REFERENCES `Usager` (`username`);

--
-- Contraintes pour la table `Categorie_Livre`
--
ALTER TABLE `Categorie_Livre`
  ADD CONSTRAINT `Categorie_Livre_ibfk_1` FOREIGN KEY (`isbn_livre`) REFERENCES `Livre` (`isbn`),
  ADD CONSTRAINT `Categorie_Livre_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `Categorie` (`id_categorie`);

--
-- Contraintes pour la table `Copie`
--
ALTER TABLE `Copie`
  ADD CONSTRAINT `Copie_ibfk_1` FOREIGN KEY (`isbn_livre`) REFERENCES `Livre` (`isbn`);

--
-- Contraintes pour la table `Critique`
--
ALTER TABLE `Critique`
  ADD CONSTRAINT `Critique_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id`);

--
-- Contraintes pour la table `Demande`
--
ALTER TABLE `Demande`
  ADD CONSTRAINT `Demande_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `Auteur` (`id`),
  ADD CONSTRAINT `Demande_ibfk_2` FOREIGN KEY (`isbn_livre`) REFERENCES `Livre` (`isbn`),
  ADD CONSTRAINT `Demande_ibfk_3` FOREIGN KEY (`employe_matricule`) REFERENCES `Employe` (`id`),
  ADD CONSTRAINT `Demande_ibfk_4` FOREIGN KEY (`id_critique`) REFERENCES `Critique` (`id_critique`);

--
-- Contraintes pour la table `Employe`
--
ALTER TABLE `Employe`
  ADD CONSTRAINT `Employe_ibfk_1` FOREIGN KEY (`username_usager`) REFERENCES `Usager` (`username`);

--
-- Contraintes pour la table `Emprunt`
--
ALTER TABLE `Emprunt`
  ADD CONSTRAINT `Emprunt_ibfk_1` FOREIGN KEY (`id_copie`) REFERENCES `Copie` (`id_copie`),
  ADD CONSTRAINT `Emprunt_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id`);

--
-- Contraintes pour la table `Genre_Livre`
--
ALTER TABLE `Genre_Livre`
  ADD CONSTRAINT `Genre_Livre_ibfk_1` FOREIGN KEY (`isbn_livre`) REFERENCES `Livre` (`isbn`),
  ADD CONSTRAINT `Genre_Livre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `Genre` (`id_genre`);

--
-- Contraintes pour la table `Livre`
--
ALTER TABLE `Livre`
  ADD CONSTRAINT `Livre_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `Auteur` (`id`);

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `Reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id`),
  ADD CONSTRAINT `Reservation_ibfk_2` FOREIGN KEY (`isbn_livre`) REFERENCES `Livre` (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
