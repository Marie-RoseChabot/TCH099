-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 18 mars 2024 à 17:24
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

--
-- Déchargement des données de la table `Auteur`
--

INSERT INTO `Auteur` (`id`, `username_usager`) VALUES
(1, 'test');

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`id`, `est_abonne`) VALUES
(1, 1);

--
-- Déchargement des données de la table `Usager`
--

INSERT INTO `Usager` (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`) VALUES
('test', 'test', 'test', 'test', 'test', '2024-03-01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
