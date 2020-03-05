-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 17 Mai 2016 à 14:16
-- Version du serveur: 5.5.49-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `PROJECT_ROULETTE`
--

-- --------------------------------------------------------

--
-- Structure de la table `elevesio`
--

CREATE TABLE IF NOT EXISTS `elevesio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `classe` varchar(10) NOT NULL,
  `section` varchar(4) NOT NULL,
  `bool` tinyint(1) NOT NULL,
  `nbpassage` int(5) NOT NULL,
  `absence` int(2) NOT NULL DEFAULT '0',
  `noteaddition` int(100) NOT NULL,
  `notetotale` int(10) NOT NULL,
  `moyenne` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Contenu de la table `elevesio`
--

INSERT INTO `elevesio` (`id`, `nom`, `prenom`, `classe`, `section`, `bool`, `nbpassage`, `absence`, `noteaddition`, `notetotale`, `moyenne`) VALUES
(1, 'Anneg', 'Romain', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(2, 'Arnould', 'Kévin', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(3, 'Peltiez', 'Axel', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(4, 'Hubert', 'Victor', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(5, 'Lejeune', 'Lucie', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(6, 'Lefeve', 'Anthony', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(7, 'Getin', 'Ronan', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(8, 'Jacquemin', 'Benjamin', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(9, 'Janecki', 'Corentin', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(10, 'Delhaise', 'Remy', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(11, 'Paquin', 'John', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(12, 'Delghust', 'Jessy', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(13, 'Muterel', 'Lucie', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(14, 'Lecompte', 'Julien', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(15, 'Grafteaux', 'Mariane', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(16, 'Avelange', 'Flavien', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(17, 'Chappe', 'Valentin', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(18, 'Fuzellier', 'Arthur', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, NULL),
(19, 'Pardonche', 'Julien', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(20, 'Georges', 'Pierrick', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(21, 'Duplaix', 'Pierre', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(23, 'Poquet', 'Gauthier', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(24, 'Harang', 'Gauthier', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(26, 'Lacourt', 'Sonny', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(27, 'Leroy', 'Kevin', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(28, 'Hilger', 'Sebastien', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(29, 'Meftah', 'Lucas', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(30, 'Leroy', 'Jonathan', 'SIO2', 'SISR', 0, 0, 0, 0, 0, NULL),
(31, 'BEGUE', 'Theo', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(32, 'BEN REJEB', 'Razi', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(33, 'BETTINELI', 'Thomas', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(34, 'BILLARD', 'Maximilien', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(35, 'BOUDRIQUE', 'Victor', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(36, 'CHAUWIN', 'Cedric', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(37, 'CHAYOT', 'Thibaut', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(38, 'COQUET', 'Donovan', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(39, 'COURIER', 'Valentin', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(40, 'DEMARLY', 'Lucas', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(41, 'DOCQ', 'Gregory', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(42, 'DUJEUX', 'Aurelien', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(43, 'FERNANDES', 'Benoit', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(44, 'GESNOT', 'Corentin', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(45, 'GRESSIER', 'Dylan', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(46, 'HELIOT', 'Thimoté', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(47, 'KALUZNY', 'Geoffrey', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(48, 'LAMBERT', 'Ruddy', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(49, 'LARNACK', 'Damien', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(50, 'LE GUINIO', 'Florentin', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(51, 'LONGNIAUX', 'Guillaume', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(52, 'MADAMA', 'Thomas', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(53, 'MAILLARD', 'Theo', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(54, 'MIDOUX', 'Kevin', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(55, 'PADOVAN', 'Alexandre', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(56, 'PETITFILS', 'Florian', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(57, 'PICHE', 'Alexis', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(58, 'PIETOT', 'Maxence', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(59, 'PITON', 'Tony', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(60, 'PORQUET', 'Vincent', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(61, 'REMY', 'Theo', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(62, 'ROBERT', 'Julien', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, NULL),
(63, 'SAIDI', 'Mohammed', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL),
(64, 'TREILLE', 'Alexis', 'SIO1', 'SISR', 0, 0, 0, 0, 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
