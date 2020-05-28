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

	$datafeed = "INSERT INTO `student` (`surname`, `firstname`, `class`) VALUES
	('BEGUE', 'Theo', 'TEST'),
	('BEN REJEB', 'Razi', 'TEST'),
	('BETTINELI', 'Thomas', 'TEST'),
	('BILLARD', 'Maximilien', 'TEST'),
	('BOUDRIQUE', 'Victor', 'TEST'),
	('CHAUWIN', 'Cedric', 'TEST'),
	('CHAYOT', 'Thibaut', 'TEST'),
	('COQUET', 'Donovan', 'TEST'),
	('COURIER', 'Valentin', 'TEST'),
	('DEMARLY', 'Lucas', 'TEST'),
	('DOCQ', 'Gregory', 'TEST'),
	('DUJEUX', 'Aurelien', 'TEST'),
	('FERNANDES', 'Benoit', 'TEST'),
	('GESNOT', 'Corentin', 'TEST'),
	('GRESSIER', 'Dylan', 'TEST'),
	('HELIOT', 'Thimoté', 'TEST'),
	('KALUZNY', 'Geoffrey', 'TEST'),
	('LAMBERT', 'Ruddy', 'TEST'),
	('LARNACK', 'Damien', 'TEST'),
	('LE GUINIO', 'Florentin', 'TEST'),
	('LONGNIAUX', 'Guillaume', 'TEST'),
	('MADAMA', 'Thomas', 'TEST'),
	('MAILLARD', 'Theo', 'TEST'),
	('MIDOUX', 'Kevin', 'TEST'),
	('PADOVAN', 'Alexandre', 'TEST'),
	('PETITFILS', 'Florian', 'TEST'),
	('PICHE', 'Alexis', 'TEST'),
	('PIETOT', 'Maxence', 'TEST'),
	('PITON', 'Tony', 'TEST'),
	('PORQUET', 'Vincent', 'TEST'),
	('REMY', 'Theo', 'TEST'),
	('ROBERT', 'Julien', 'TEST'),
	('SAIDI', 'Mohammed', 'TEST'),
	('TREILLE', 'Alexis', 'TEST');";
?>