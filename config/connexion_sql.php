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

	$datafeed = "INSERT INTO `student` (`surname`, `firstname`, `class`, `bool`, `passage`, `absence`, `noteaddition`, `notetotal`, `average`) VALUES
	('BEGUE', 'Theo', 'TEST', 0, 0, 0, 0, 0, 0),
	('BEN REJEB', 'Razi', 'TEST', 0, 0, 0, 0, 0, 0),
	('BETTINELI', 'Thomas', 'TEST', 0, 0, 0, 0, 0, 0),
	('BILLARD', 'Maximilien', 'TEST', 0, 0, 0, 0, 0, 0),
	('BOUDRIQUE', 'Victor', 'TEST', 0, 0, 0, 0, 0, 0),
	('CHAUWIN', 'Cedric', 'TEST', 0, 0, 0, 0, 0, 0),
	('CHAYOT', 'Thibaut', 'TEST', 0, 0, 0, 0, 0, 0),
	('COQUET', 'Donovan', 'TEST', 0, 0, 0, 0, 0, 0),
	('COURIER', 'Valentin', 'TEST', 0, 0, 0, 0, 0, 0),
	('DEMARLY', 'Lucas', 'TEST', 0, 0, 0, 0, 0, 0),
	('DOCQ', 'Gregory', 'TEST', 0, 0, 0, 0, 0, 0),
	('DUJEUX', 'Aurelien', 'TEST', 0, 0, 0, 0, 0, 0),
	('FERNANDES', 'Benoit', 'TEST', 0, 0, 0, 0, 0, 0),
	('GESNOT', 'Corentin', 'TEST', 0, 0, 0, 0, 0, 0),
	('GRESSIER', 'Dylan', 'TEST', 0, 0, 0, 0, 0, 0),
	('HELIOT', 'Thimoté', 'TEST', 0, 0, 0, 0, 0, 0),
	('KALUZNY', 'Geoffrey', 'TEST', 0, 0, 0, 0, 0, 0),
	('LAMBERT', 'Ruddy', 'TEST', 0, 0, 0, 0, 0, 0),
	('LARNACK', 'Damien', 'TEST', 0, 0, 0, 0, 0, 0),
	('LE GUINIO', 'Florentin', 'TEST', 0, 0, 0, 0, 0, 0),
	('LONGNIAUX', 'Guillaume', 'TEST', 0, 0, 0, 0, 0, 0),
	('MADAMA', 'Thomas', 'TEST', 0, 0, 0, 0, 0, 0),
	('MAILLARD', 'Theo', 'TEST', 0, 0, 0, 0, 0, 0),
	('MIDOUX', 'Kevin', 'TEST', 0, 0, 0, 0, 0, 0),
	('PADOVAN', 'Alexandre', 'TEST', 0, 0, 0, 0, 0, 0),
	('PETITFILS', 'Florian', 'TEST', 0, 0, 0, 0, 0, 0),
	('PICHE', 'Alexis', 'TEST', 0, 0, 0, 0, 0, 0),
	('PIETOT', 'Maxence', 'TEST', 0, 0, 0, 0, 0, 0),
	('PITON', 'Tony', 'TEST', 0, 0, 0, 0, 0, 0),
	('PORQUET', 'Vincent', 'TEST', 0, 0, 0, 0, 0, 0),
	('REMY', 'Theo', 'TEST', 0, 0, 0, 0, 0, 0),
	('ROBERT', 'Julien', 'TEST', 0, 0, 0, 0, 0, 0),
	('SAIDI', 'Mohammed', 'TEST', 0, 0, 0, 0, 0, 0),
	('TREILLE', 'Alexis', 'TEST', 0, 0, 0, 0, 0, 0);";
?>