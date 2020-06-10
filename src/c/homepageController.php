<?php

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new StudentManager($bdd);

require 'src/m/function.php';

//fonction RESET PASSAGE, pour seulement reset les passages et non les moyennes, absences etc...
if (isset($_POST['Resetpass'])) {
	$manager->updateDb('bool = false, absence = false','class = "' . $_SESSION['select_classe'] . '"');
}
//fonction RESET ALL, pour remettre à 0 tout (passages, moyennes, notes, absences etc...)
if (isset($_POST['Resetall'])) {
	$manager->updateDb('bool= false, passage= 0, absence= false, noteaddition= NULL, notetotal= NULL, average = NULL','class = "' . $_SESSION['select_classe'] . '"');
}

//Action lors du clique "A" pour les absences (ajouter +1 dans absence et -1 au passage dans la BDD vu que l'élève avait reçu un +1 lorsqu'il a été tiré au sort)
if(isset($_POST['A'])) {
	$object = $_SESSION['student'];

	$object->setAbsence(true);
	$manager->update($object);
}

if(isset($_POST['Nt0'])) {
	//Action lors du clique "0" pour la note de 0. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	
	$object = $_SESSION['student'];
	if(isset($_POST['retour'])){
		$object = $manager->getDb("*","id = " . $_POST['retour']);
		$donnees = $object->fetch(PDO::FETCH_ASSOC);
		$object = new Student($donnees);
		$object->setAbsence(false);
	}
	
	//on ajoute +1 pour dire qu'il a été tiré au sort.
	$passage = $object->getPassage();
	$object->setBool(true);
	$object->setPassage($passage + 1);

	$noteaddition = $object->getNoteaddition();
	$notetotal = $object->getNotetotal();

	if($noteaddition === NULL){
		$noteaddition = 0;
	}
	if($notetotal === NULL){
		$notetotal = 0;
	}

	$object->setNoteaddition($noteaddition + 0);
	$object->setNotetotal($notetotal + 1);
	$object->setAverage($object->getNoteaddition()/$object->getNotetotal());
	$manager->update($object);
}

if(isset($_POST['Nt1'])) {
	//Action lors du clique "1" pour la note 1. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$object = $_SESSION['student'];
	if(isset($_POST['retour'])){
		$object = $manager->getDb("*","id = " . $_POST['retour']);
		$donnees = $object->fetch(PDO::FETCH_ASSOC);
		$object = new Student($donnees);
		$object->setAbsence(false);
	}

	//on ajoute +1 pour dire qu'il a été tiré au sort.
	$passage = $object->getPassage();
	$object->setBool(true);
	$object->setPassage($passage + 1);

	$noteaddition = $object->getNoteaddition();
	$notetotal = $object->getNotetotal();

	if($noteaddition === NULL){
		$noteaddition = 0;
	}
	if($notetotal === NULL){
		$notetotal = 0;
	}

	$object->setNoteaddition($noteaddition + 1);
	$object->setNotetotal($notetotal + 1);
	$object->setAverage($object->getNoteaddition()/$object->getNotetotal());
	$manager->update($object);
}

if(isset($_POST['Nt3'])) {
	//Action lors du clique "3" pour la note 3. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$object = $_SESSION['student'];
	if(isset($_POST['retour'])){
		$object = $manager->getDb("*","id = " . $_POST['retour']);
		$donnees = $object->fetch(PDO::FETCH_ASSOC);
		$object = new Student($donnees);
		$object->setAbsence(false);
	}

	//on ajoute +1 pour dire qu'il a été tiré au sort.
	$bool = $object->getBool();
	$passage = $object->getPassage();
	$object->setBool(true);
	$object->setPassage($passage + 1);

	$noteaddition = $object->getNoteaddition();
	$notetotal = $object->getNotetotal();

	if($noteaddition === NULL){
		$noteaddition = 0;
	}
	if($notetotal === NULL){
		$notetotal = 0;
	}

	$object->setNoteaddition($noteaddition + 3);
	$object->setNotetotal($notetotal + 1);
	$object->setAverage($object->getNoteaddition()/$object->getNotetotal());
	$manager->update($object);
}

require 'src/v/homepageView.php';

