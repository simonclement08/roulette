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

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `bool` tinyint(1) NOT NULL DEFAULT 0,
  `passage` int(5) NOT NULL DEFAULT 0,
  `absence` int(2) NOT NULL DEFAULT 0,
  `noteaddition` int(100) NOT NULL DEFAULT 0,
  `notetotal` int(10) NOT NULL DEFAULT 0,
  `average` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Contenu de la table `elevesio`
--

INSERT INTO `student` (`id`, `surname`, `firstname`, `class`, `section`, `bool`, `passage`, `absence`, `noteaddition`, `notetotal`, `average`) VALUES
(1, 'Anneg', 'Romain', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(2, 'Arnould', 'Kévin', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(3, 'Peltiez', 'Axel', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(4, 'Hubert', 'Victor', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(5, 'Lejeune', 'Lucie', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(6, 'Lefeve', 'Anthony', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(7, 'Getin', 'Ronan', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(8, 'Jacquemin', 'Benjamin', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(9, 'Janecki', 'Corentin', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(10, 'Delhaise', 'Remy', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(11, 'Paquin', 'John', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(12, 'Delghust', 'Jessy', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(13, 'Muterel', 'Lucie', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(14, 'Lecompte', 'Julien', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(15, 'Grafteaux', 'Mariane', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(16, 'Avelange', 'Flavien', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(17, 'Chappe', 'Valentin', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(18, 'Fuzellier', 'Arthur', 'SIO2', 'SLAM', 0, 0, 0, 0, 0, 0),
(19, 'Pardonche', 'Julien', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(20, 'Georges', 'Pierrick', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(21, 'Duplaix', 'Pierre', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(23, 'Poquet', 'Gauthier', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(24, 'Harang', 'Gauthier', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(26, 'Lacourt', 'Sonny', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(27, 'Leroy', 'Kevin', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(28, 'Hilger', 'Sebastien', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(29, 'Meftah', 'Lucas', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(30, 'Leroy', 'Jonathan', 'SIO2', 'SISR', 0, 0, 0, 0, 0, 0),
(31, 'BEGUE', 'Theo', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(32, 'BEN REJEB', 'Razi', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(33, 'BETTINELI', 'Thomas', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(34, 'BILLARD', 'Maximilien', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(35, 'BOUDRIQUE', 'Victor', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(36, 'CHAUWIN', 'Cedric', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(37, 'CHAYOT', 'Thibaut', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(38, 'COQUET', 'Donovan', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(39, 'COURIER', 'Valentin', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(40, 'DEMARLY', 'Lucas', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(41, 'DOCQ', 'Gregory', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(42, 'DUJEUX', 'Aurelien', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(43, 'FERNANDES', 'Benoit', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(44, 'GESNOT', 'Corentin', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(45, 'GRESSIER', 'Dylan', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(46, 'HELIOT', 'Thimoté', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(47, 'KALUZNY', 'Geoffrey', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(48, 'LAMBERT', 'Ruddy', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(49, 'LARNACK', 'Damien', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(50, 'LE GUINIO', 'Florentin', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(51, 'LONGNIAUX', 'Guillaume', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(52, 'MADAMA', 'Thomas', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(53, 'MAILLARD', 'Theo', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(54, 'MIDOUX', 'Kevin', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(55, 'PADOVAN', 'Alexandre', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(56, 'PETITFILS', 'Florian', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(57, 'PICHE', 'Alexis', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(58, 'PIETOT', 'Maxence', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(59, 'PITON', 'Tony', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(60, 'PORQUET', 'Vincent', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(61, 'REMY', 'Theo', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(62, 'ROBERT', 'Julien', 'SIO1', 'SLAM', 0, 0, 0, 0, 0, 0),
(63, 'SAIDI', 'Mohammed', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0),
(64, 'TREILLE', 'Alexis', 'SIO1', 'SISR', 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
