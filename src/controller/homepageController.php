<?php
require 'controller/bdd.php';

$bdd = connexion_bdd();
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new StudentManager($bdd);

require 'controller/function.php';
require 'view/homepageView.php';

//fonction RESET PASSAGE, pour seulement reset les passages et non les moyennes, absences etc...
if (isset($_POST['Resetpass'])) {
	$manager->updateDb('bool = 0','class = "' . $_SESSION['select_classe'] . '"');
}
//fonction RESET ALL, pour remettre à 0 tout (passages, moyennes, notes, absences etc...)
if (isset($_POST['Resetall'])) {
	$manager->updateDb('bool= 0, passage= 0, absence= 0, noteaddition= 0, notetotal= 0, average = 0','class = "' . $_SESSION['select_classe'] . '"');
}

//Action lors du clique "A" pour les absences (ajouter +1 dans absence et -1 au passage dans la BDD vu que l'élève avait reçu un +1 lorsqu'il a été tiré au sort)
if(isset($_POST['A'])) {
	$object = $_SESSION['student'];
	$absence = $object->getAbsence();
	$passage = $object->getPassage();
	$bool = $object->getBool();
	$object->setAbsence($absence + 1);
	$object->setPassage($passage - 1);
	$object->setBool($bool - 1);
	$manager->update($object);
	
	echo  "<br/>L'élève est noté absent.<br/>";
}
  

  if(isset($_POST['Nt0'])) {
	//Action lors du clique "0" pour la note de 0. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$object = $_SESSION['student'];
	$object->setNoteaddition($object->getNoteaddition() + 0);
	$object->setNotetotal($object->getNotetotal() + 1);
	$object->setAverage($object->getNoteaddition()/$object->getNotetotal());
	$manager->update($object);
	
	echo  "<br/>L'élève a obtenu la note de \"0\".<br/>";
  }

  if(isset($_POST['Nt1'])) {
	//Action lors du clique "1" pour la note 1. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$object = $_SESSION['student'];
	$object->setNoteaddition($object->getNoteaddition() + 1);
	$object->setNotetotal($object->getNotetotal() + 1);
	$object->setAverage($object->getNoteaddition()/$object->getNotetotal());
	$manager->update($object);
	
	echo  "<br/>L'élève a obtenu la note de \"1\".<br/>";
  }

  if(isset($_POST['Nt3'])) {
	//Action lors du clique "3" pour la note 3. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$object = $_SESSION['student'];
	$object->setNoteaddition($object->getNoteaddition() + 3);
	$object->setNotetotal($object->getNotetotal() + 1);
	$object->setAverage($object->getNoteaddition()/$object->getNotetotal());
	$manager->update($object);
	
	echo  "<br/>L'élève a obtenu la note de \"3\".<br/>";
  }
