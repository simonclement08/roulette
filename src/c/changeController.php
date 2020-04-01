<?php

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new StudentManager($bdd);

require 'src/v/changeView.php';

if (isset($_POST['add'])) {
	$donnees['surname'] = $_POST['addnom'];
	$donnees['firstname'] = $_POST['addprenom'];
	$donnees['class'] = $_POST['addclasse'];
	$donnees['bool'] = 0;
	$donnees['passage'] = 0;
	$donnees['absence'] = 0;
	$donnees['noteaddition'] = 0;
	$donnees['notetotal'] = 0;
	$donnees['average'] = 0;
	$object = new Student($donnees);
	$manager->add($object);
	echo '<h4 style="color:green;">L\'étudiant a bien été ajouté à la BDD.</h4>';
}

if (isset($_POST['del'])) {
	$object = $_POST['listemod'];
	$object = urldecode($object);
    $object = unserialize($object);
	$manager->delete($object);
	echo '<h4 style="color:green;">L\'étudiant a bien été supprimé de la BDD.</h4>';
}

//TRAITEMENT FICHIER CLASSE

if(!empty($_POST['upload'])) {																// Verifie si le formulaire est envoyé

	$tmp_file = $_FILES['import']['tmp_name']; 													// Recup du nom du fichier
	$file = $_FILES['import']['name'];		  													// Recup du nom et de l'extension du fichier

	if(move_uploaded_file($tmp_file, $file)) { 													// Verifie si le fichier est bien présent
		echo '<h4 style="color:green;">Upload effectué avec succès !</h4>';
		chmod($file, 0777); 																		// Dans ce cas, le php attribue un chmod 777 au fichier pour le supprimer plus tard
		
		$content = file_get_contents($file);														// Stocke le contenu du fichier dans la variable
		$content = str_replace('%EF%BB%BF', '', $content);											// Supprime les caractères BOM "ï»¿" qui faussent la requète en s'insérant dans la chaine de caractère
		$content = str_replace('(', '', $content);
		$content = explode('),', $content);
		$content = str_replace(')', '', $content);
		foreach($content as $data){
			$data = explode(',', $data);
			$data = str_replace('"', '', $data);
			$donnees['surname'] = $data[0];
			$donnees['firstname'] = $data[1];
			$donnees['class'] = $data[2];
			$donnees['bool'] = 0;
			$donnees['passage'] = 0;
			$donnees['absence'] = 0;
			$donnees['noteaddition'] = 0;
			$donnees['notetotal'] = 0;
			$donnees['average'] = 0;
			$object = new Student($donnees);
			$manager->add($object);
		}
		unlink($file); 																				// Supprime le fichier txt
	}
	else { 																						// Si problème d'upload
		echo '<h4 style="color:red;">Echec de l\'upload !</h4>';
	}
}

if(!empty($_POST['classup'])) {
	$manager->deleteClasse($_POST['supp_classe']);
	echo '<h4 style="color:green;">La classe a bien été supprimée de la BDD.</h4>';
}
