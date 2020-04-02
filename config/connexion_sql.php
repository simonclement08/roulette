<?php

	require_once 'config.php';

	try
	{
		$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	$datafeed = "INSERT INTO `student` (`id`, `surname`, `firstname`, `class`, `section`, `bool`, `passage`, `absence`, `noteaddition`, `notetotal`, `average`) VALUES
	(1, 'Anneg', 'Romain', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(2, 'Arnould', 'Kévin', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(3, 'Peltiez', 'Axel', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(4, 'Hubert', 'Victor', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(5, 'Lejeune', 'Lucie', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(6, 'Lefeve', 'Anthony', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(7, 'Getin', 'Ronan', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(8, 'Jacquemin', 'Benjamin', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(9, 'Janecki', 'Corentin', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(10, 'Delhaise', 'Remy', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(11, 'Paquin', 'John', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(12, 'Delghust', 'Jessy', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(13, 'Muterel', 'Lucie', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(14, 'Lecompte', 'Julien', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(15, 'Grafteaux', 'Mariane', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(16, 'Avelange', 'Flavien', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(17, 'Chappe', 'Valentin', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(18, 'Fuzellier', 'Arthur', 'Test1', 'groupe1', 0, 0, 0, 0, 0, 0),
	(19, 'Pardonche', 'Julien', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(20, 'Georges', 'Pierrick', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(21, 'Duplaix', 'Pierre', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(23, 'Poquet', 'Gauthier', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(24, 'Harang', 'Gauthier', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(26, 'Lacourt', 'Sonny', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(27, 'Leroy', 'Kevin', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(28, 'Hilger', 'Sebastien', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(29, 'Meftah', 'Lucas', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(30, 'Leroy', 'Jonathan', 'Test1', 'groupe2', 0, 0, 0, 0, 0, 0),
	(31, 'BEGUE', 'Theo', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(32, 'BEN REJEB', 'Razi', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(33, 'BETTINELI', 'Thomas', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(34, 'BILLARD', 'Maximilien', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(35, 'BOUDRIQUE', 'Victor', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(36, 'CHAUWIN', 'Cedric', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(37, 'CHAYOT', 'Thibaut', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(38, 'COQUET', 'Donovan', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(39, 'COURIER', 'Valentin', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(40, 'DEMARLY', 'Lucas', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(41, 'DOCQ', 'Gregory', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(42, 'DUJEUX', 'Aurelien', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(43, 'FERNANDES', 'Benoit', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(44, 'GESNOT', 'Corentin', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(45, 'GRESSIER', 'Dylan', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(46, 'HELIOT', 'Thimoté', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(47, 'KALUZNY', 'Geoffrey', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(48, 'LAMBERT', 'Ruddy', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(49, 'LARNACK', 'Damien', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(50, 'LE GUINIO', 'Florentin', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(51, 'LONGNIAUX', 'Guillaume', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(52, 'MADAMA', 'Thomas', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(53, 'MAILLARD', 'Theo', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(54, 'MIDOUX', 'Kevin', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(55, 'PADOVAN', 'Alexandre', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(56, 'PETITFILS', 'Florian', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(57, 'PICHE', 'Alexis', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(58, 'PIETOT', 'Maxence', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(59, 'PITON', 'Tony', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(60, 'PORQUET', 'Vincent', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(61, 'REMY', 'Theo', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(62, 'ROBERT', 'Julien', 'Test2', 'groupe1', 0, 0, 0, 0, 0, 0),
	(63, 'SAIDI', 'Mohammed', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0),
	(64, 'TREILLE', 'Alexis', 'Test2', 'groupe2', 0, 0, 0, 0, 0, 0);";
?>