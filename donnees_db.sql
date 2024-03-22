-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : ven. 22 mars 2024 à 01:17
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
-- Déchargement des données de la table `Usager`
--

INSERT INTO `Usager` (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`) VALUES
('agathachristie', 'password', NULL, 'Agatha', 'Christie', '1890-09-15'),
('antoinedestexupery', 'password', NULL, 'de Saint-Exupéry', 'Antoine', '1900-06-20'),
('georgeorwell', 'password', NULL, 'Orwell', 'George', '1903-06-25'),
('janeausten', 'password', NULL, 'Austen', 'Jane', '1775-12-16'),
('jkrowling', 'password', NULL, 'Rowling', 'J.K.', '1965-07-31'),
('jrrtolkien', 'password', NULL, 'Tolkien', 'J.R.R.', '1892-01-03'),
('renedescartes', 'password', NULL, 'René', 'Descartes', '1596-03-30'),
('renegoscinny', 'password', NULL, 'Goscinny', 'René', '1926-08-14'),
('stefanzweig', 'password', NULL, 'Zweig', 'Stefan', '1881-11-27'),
('victorhugo', 'password', NULL, 'Hugo', 'Victor', '1802-02-26');

--
-- Déchargement des données de la table `Auteur`
--

INSERT INTO `Auteur` (`id`, `username_usager`) VALUES
(13, 'agathachristie'),
(3, 'antoinedestexupery'),
(7, 'georgeorwell'),
(8, 'janeausten'),
(1, 'jkrowling'),
(2, 'jrrtolkien'),
(10, 'renedescartes'),
(12, 'renegoscinny'),
(9, 'stefanzweig'),
(11, 'victorhugo');

--
-- Déchargement des données de la table `Livre`
--

INSERT INTO `Livre` (`isbn`, `titre`, `maison_edition`, `annee`, `url_image`, `description_livre`, `id_auteur`) VALUES
(9782012101388, 'Astérix et Cléopâtre', 'Hachette', 1965, 'https://m.media-amazon.com/images/I/81Dirt03cbL._AC_UF1000,1000_QL80_.jpg', 'Astérix habite dans le seul village de Gaule où la Rome de Jules César n\'a pas réussi à prendre le contrôle. L\'atout des gaulois est la potion magique de leur druide Panoramix, qui rend invincible quiconque la boit. Dans cet album, les gaulois aident à construire une pyramide avec la force que la potion leur donne afin d\'éviter la colère de la reine Cléopâtre à celui qui est chargé du projet.', 12),
(9782070338665, 'Orgueil et Préjugés', 'Gallimard', 1813, 'https://images.renaud-bray.com/images/PG/853/853267-gf.jpg?404=404RB.gif', 'Une histoire d\'amour d\'autrefois où une jeune femme hésite entre deux hommes qui sont très différents l\'un de l\'autre. Ce récit du XIXe siècle est encore très au goût du jour et jette un coup d\'œil en profondeur sur les relations amoureuses et leur évolution.', 8),
(9782070408504, 'Le Petit Prince', 'Gallimard', 1943, 'https://images.renaud-bray.com/images/PG/3/3760-gf.jpg?404=404RB.gif', 'Le Petit Prince est l\'histoire d\'un petit garçon qui vit sur sa petite planète avec une seule rose. Cela peut sembler banal au premier degré, mais ce livre classique très symbolique saura inspirer petits et grands.', 3),
(9782070584628, 'Harry Potter à l\'école des sorciers', 'Gallimard', 1997, 'https://bookclubs.scholastic.ca/dw/image/v2/AAXY_PRD/on/demandware.static/-/Sites-master-catalog-cec-ca/default/dw9665b877/products/9782070584628.jpg?sw=440&sh=440&sm=fit&sfrm=jpg', 'Harry Potter, un jeune garçon se croyant normal, vit chez son oncle et sa tante. Il mène une triste vie de laissé-pour-compte jusqu\'au jour où il reçoit une lettre mystérieuse de l\'école de Poudlard qui va changer sa vie.', 1),
(9782070612888, 'Le seigneur des anneaux, tome 1 : La communauté de l\'anneau', 'Pocket', 1954, 'https://images.leslibraires.ca/books/9782266120999/front/9782266120999_large.jpg', 'Frodo Baggins, un petit Hobbit de la terre du milieu se voit confier une tâche immense par son ami, le mage Gandalf le Gris. Il doit tenter de détruire le terrible anneau du pouvoir. Cependant, il ne sera pas seul dans cette aventure, car la communauté de l\'anneau est la pour le protéger.', 2),
(9782072878497, '1984', 'Gallimard', 1949, 'https://images.renaud-bray.com/images/PG/3442/3442760-gf.jpg?404=404RB.gif', 'Dans ce livre écrit en 1949, le gouvernement est devenu une dictature où tout le monde est strictement surveillé. Cette dystopie classique est à l\'origine de l\'expression encore utilisée aujourd\'hui \"Big Brother\", qui était le chef d\'état dans ce roman. Ainsi, ce roman datant d\'il y a plus de 70 ans est encore très d\'actualité.', 7),
(9782100856404, 'Discours de la méthode', 'Dunod', 1637, 'https://images.renaud-bray.com/images/PG/4037/4037537-gf.jpg?404=404RB.gif', 'Cette ouvrage philosophique de René Descartes est un grand classique qui a changé la manière de raisonner de l\'humain. Il peut même être considéré comme précurseur du siècles des Lumières. Dans ce livre, il aborde entre autre sa célèbre réflexion, « Je pense, donc je suis. » Le texte a été adapté en français moderne par l\'éditeur.', 10),
(9782253010210, 'Le Crime de l\'Orient-Express', 'Le Livre de Poche', 1934, 'https://images.renaud-bray.com/images/PG/20/20571-gf.jpg?404=404RB.gif', 'Le célèbre détective Hercule Poirot voyage à bord de train où un homme est assassiné. Sa réputation le précédant, il est mis en charge d\'une enquête à huis clos où aucun suspect ne semble pouvoir être coupable.', 13),
(9782253146698, 'Marie-Antoinette', 'Le Livre de Poche', 1932, 'https://images.renaud-bray.com/images/PG/7/7525-gf.jpg?404=404RB.gif', 'Marie-Antoinette, la dernière reine de France, est célèbre pour l\'opinion négatif que le peuple français avait pour elle. Cependant, sa manière d\'agir et sa personnalités sont beaucoup moins connues. Cette biographie historique les met à jour grâce à une correspondance qu\'elle entretenait avec un Compte Suédois dénommé Axel de Fersen.', 9),
(9782372490917, 'Les Misérables - Édition intégrale', 'Limbroglio', 1862, 'https://m.media-amazon.com/images/I/41nGZ1bdfFL._SY466_.jpg', 'Un des plus grands livres de critique sociale de l\'histoire écrit par le fameux Victor Hugo. Cet ouvrage est donne un coup d\'œil sur le XIXe siècle d\'un point de vue beaucoup plus rapproché que celui des livres historiques contemporains.', 11),
(9782756020037, 'Bilbo le Hobbit', 'Delcourt', 1937, 'https://images.renaud-bray.com/images/PG/1052/1052684-gf.jpg?404=404RB.gif', 'Dans ce roman, la vie tranquille de Bilbo le Hobbit est chamboulé par le mage Gandalf le Gris et un groupe de Nains qui l\'amènent à l\'aventure. Ils ont besoin de son aide afin de mettre la main sur un trésor gardé de près par un redoutable dragon.', 2);

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`id_categorie`, `nom`) VALUES
(1, 'Aventure'),
(2, 'Biographique'),
(3, 'Jeunesse'),
(4, 'Fantastique'),
(5, 'Historique'),
(6, 'Policier'),
(7, 'Romance'),
(8, 'Science-Fiction'),
(9, 'Horreur'),
(10, 'Suspense'),
(11, 'Action'),
(12, 'Tragédie');

--
-- Déchargement des données de la table `Categorie_Livre`
--

INSERT INTO `Categorie_Livre` (`isbn_livre`, `id_categorie`) VALUES
(9782012101388, 1),
(9782070612888, 1),
(9782756020037, 1),
(9782253146698, 2),
(9782012101388, 3),
(9782070408504, 3),
(9782070584628, 3),
(9782070408504, 4),
(9782070584628, 4),
(9782070612888, 4),
(9782756020037, 4),
(9782253146698, 5),
(9782253010210, 6),
(9782070338665, 7),
(9782072878497, 8),
(9782072878497, 10),
(9782012101388, 11),
(9782070612888, 11),
(9782756020037, 11),
(9782372490917, 12);

--
-- Déchargement des données de la table `Type`
--

INSERT INTO `Type` (`id_type`, `nom`) VALUES
(1, 'Bandes dessinées'),
(2, 'Contes'),
(3, 'Documentaires'),
(4, 'Essais'),
(5, 'Journaux'),
(6, 'Magazines'),
(7, 'Mangas'),
(8, 'Ouvrages de référence'),
(9, 'Nouvelles'),
(10, 'Philosophie'),
(11, 'Poésie'),
(12, 'Romans');

--
-- Déchargement des données de la table `Type_Livre`
--

INSERT INTO `Type_Livre` (`isbn_livre`, `id_type`) VALUES
(9782012101388, 1),
(9782253146698, 3),
(9782100856404, 10),
(9782070338665, 12),
(9782070408504, 12),
(9782070584628, 12),
(9782072878497, 12),
(9782253010210, 12),
(9782253146698, 12),
(9782372490917, 12),
(9782756020037, 12);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
