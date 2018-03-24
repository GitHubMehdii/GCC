-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 04 mars 2018 à 16:15
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tp2`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `num_client` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(13) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datenaiss` date NOT NULL,
  `adresse` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_inscrip` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`num_client`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`num_client`, `nom`, `prenom`, `telephone`, `email`, `datenaiss`, `adresse`, `date_inscrip`) VALUES
(3, 'chaoui', 'el mehdi', 669664456, 'mehdi@gmail.com', '1995-12-05', 'ain chock rue 33 n 16', '2018-03-03 22:41:17'),
(4, 'cherkaoui', 'abdelkbir', 611354466, 'abdo@gmail.com', '1995-12-05', 'ain chock rue 33', '2018-03-03 22:42:22'),
(5, 'ggg', 'mnnn', 611350528, 'hhhhh@hhhhhh', '2000-12-01', 'bbbb', '2018-03-04 16:03:51'),
(6, 'gallouche', 'hamza', 611350528, 'lelurar@youzend.net', '2000-03-01', 'ain chock rue 33', '2018-03-04 16:07:34');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `tournee` int(11) NOT NULL,
  `num_facture` int(10) NOT NULL AUTO_INCREMENT,
  `num_client` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `agence` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `debut_consom` date NOT NULL,
  `fin_consom` date NOT NULL,
  `energie_consommee` int(11) NOT NULL,
  `date_limit` date NOT NULL,
  PRIMARY KEY (`num_facture`),
  KEY `num_client` (`num_client`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`tournee`, `num_facture`, `num_client`, `nom`, `agence`, `debut_consom`, `fin_consom`, `energie_consommee`, `date_limit`) VALUES
(2, 6, 3, 'chaoui', 'mandri tetouan', '1999-12-01', '1999-10-10', 199, '1999-10-10'),
(3, 7, 3, 'chaoui', 'mhannech', '2000-12-01', '2001-10-10', 400, '2001-10-10'),
(10, 9, 6, 'gallouche', 'nn', '2018-03-13', '2018-03-08', 411, '2018-03-08');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`num_client`) REFERENCES `clients` (`num_client`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
