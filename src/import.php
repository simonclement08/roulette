<?php
	include 'config/bdd.php';																		// Connexion BDD
?>

<!DOCTYPE html>
<html style="font-family:Arial">
	<head>
		<title>Import d'une classe</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
	</head>

	<a href="index.php"><h1>SIO ROULETTE</h1></a>

	<!-- AFFICHAGE INFOS -->
	
	<body>
		<form method="post" action="#" enctype="multipart/form-data">

			<input type="file" name="import" class="bouton">

			<br/><br/>

			<span>Insérez votre fichier au format .txt contenant la classe souhaitée.<br/>
			Il doit se présenter sous la forme:<br/>
			<i><p style="text-indent:20px">("nomeleve","prenomeleve","classe","option"),</p>
			<p style="text-indent:20px">("nomeleve2","prenomeleve2","classe2","option2")</p></i></span>

			<span>Il est recommandé d'encoder le fichier texte en UTF-8 sans BOM.</span>

			<br/><br/>

			<input type="submit" name="upload" value="Envoyer" class="bouton">
		</form>

		<!-- TRAITEMENT FICHIER CLASSE -->

		<?php

			if(!empty($_POST['upload'])) {																// Verifie si le formulaire est envoyé

				$tmp_file = $_FILES['import']['tmp_name']; 													// Recup du nom du fichier
				$file = $_FILES['import']['name'];		  													// Recup du nom et de l'extension du fichier

				if(move_uploaded_file($tmp_file, $file)) { 													// Verifie si le fichier est bien présent
				    echo '<br/><br/>Upload effectué avec succès !<br/>';
				    chmod($file, 0777); 																		// Dans ce cas, le php attribue un chmod 777 au fichier pour le supprimer plus tard
					
					$content = file_get_contents($file);														// Stocke le contenu du fichier dans la variable
					$content = str_replace('%EF%BB%BF', '', $content);											// Supprime les caractères BOM "ï»¿" qui faussent la requète en s'insérant dans la chaine de caractère
					
					$sql = 'INSERT INTO elevesio (nom, prenom, classe, section) VALUES '.$content.';'; 			// Requète d'insertion des données
					
						
					// echo $sql; 
					$bdd -> query($sql); 																		// Execute la requète
					
					$bdd = null; 																				// Cloture la connexion MySQL
					unlink($file); 																				// Supprime le fichier txt
				}
				else { 																						// Si problème d'upload
				    echo 'Echec de l\'upload !';
				}
			}

		?>

		<footer>
			<hr>
			<i><b>JACQUEMIN BENJAMIN</b><br/>(benjamin.jacquemin@orange.fr)</i>
		</footer>
	</body>
</html>