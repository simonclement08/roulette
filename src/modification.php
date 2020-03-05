<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>AJOUT - Tirage</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta charset="utf-8">
	</head>

	<body>

		<?php
			include 'config/bdd.php';
			$bdd = connexion_bdd();
		?>

		<a href="index.php" style="text-decoration:none;"><h1>SIO ROULETTE</h1></a>
		<br/><br/>

		<!--             -->
		<!-- AJOUT ELEVE -->
		<!--             -->

				<h3>Ajout d'un élève</h3>

				<span>Remplissez les informations nécéssaires, puis appuyez sur Ajouter.</span>

				<br/><br/>

				<form method="POST" action="#">
					<label>Nom: </label><input type="text" name="addnom">
					<label>Prénom: </label><input type="text" name="addprenom" >
					<label>Classe </label><input type="text" name="addclasse">
					<label>Section: </label><input type="text" name="addsection">
					<input type="submit" value="Ajouter" name="add">
				</form><br/>

				<?php

					$nom=$_POST['addnom'];
					$prenom=$_POST['addprenom'];
					$classe=$_POST['addclasse'];
					$section=$_POST['addsection'];

					if (isset($_POST['add'])) {

					    $req = $bdd->prepare('INSERT INTO elevesio (id, nom, prenom, classe, section, bool, nbpassage, absence, noteaddition, notetotale, moyenne)
					    		VALUES (:id, :nom, :prenom, :classe, :section, 0, 0, 0, 0, 0, 0)');
						$req->execute(array(
						'id' => '',
					    'nom' => $nom,
					    'prenom' => $prenom,
					    'classe' => $classe,
					    'section' => $section,
					    ));
					    echo '<h4 style="color:green;">L\'étudiant a bien été ajouté à la BDD.</h4>';
					}
				?>

		<br/><br/><br/><br/>

		<hr width="65%">
		<hr width="65%">

		<!--                   -->
		<!-- SUPPRESSION ELEVE -->
		<!--                   -->

				<h3>Suppression d'un élève</h3>

				<span>Choisissez la classe en appuyant sur Choix, puis l'élève, et appuyez sur Supprimer.</span>

				<br/><br/>

				<!-- Premier formulaire de selection de classe -->

				<form method="POST" action="#">
					<select name="sel_classe">
					<?php

						$sel_classe = $bdd->query('SELECT DISTINCT classe FROM elevesio ORDER BY classe ASC');

						while ($don_classe = $sel_classe->fetch()) {
							echo '<option value="'.$don_classe['classe'].'">'.$don_classe['classe'].'</option>';
						}

					?>
					</select>
					<input type="submit" value="Choix" name="choix">
				</form>

				<!-- Second formulaire de selection de l'élève à supprimer -->

				<form method="POST" action="#">
					<select name="listemod">
					<?php
						if (!empty($_POST['choix'])) {
							$liste = $bdd->query('SELECT id, nom, prenom FROM elevesio WHERE classe="'.$_POST['sel_classe'].'"');

							while ($donnees2 = $liste->fetch()) {
									echo  '<option value="'.$donnees2['id'] .'"> '. $donnees2['prenom']. ' '. $donnees2['nom']. '</option>';
							}
						}
					?>
					</select>

					<input type="submit" value="Supprimer" name="del">
				</form>

				<?php
					if (isset($_POST['del'])) {

						$lm=$_POST['listemod'];

					    $bdd->query('DELETE FROM elevesio WHERE id='. $lm .'');
					    $bdd->query('DELETE FROM elevesio WHERE id='. $lm .'');
					    echo '<h4 style="color:green;">L\'étudiant a bien été supprimé de la BDD.</h4>';
					}
				?>

		<br/><br/><br/><br/>

		<hr width="65%">
		<hr width="65%">

		<!--              -->
		<!-- AJOUT CLASSE -->
		<!--              -->

				<h3>Ajout classe</h3>

				<form method="post" action="#" enctype="multipart/form-data">

					<input type="file" name="import" class="bouton">

					<br/><br/>

					<span>Insérez votre fichier au format .txt contenant la classe souhaitée.<br/>
					Il doit se présenter sous la forme:<br/>
					<i><p style="text-indent:20px">("nomeleve","prenomeleve","classe","option"),</p>
					<p style="text-indent:20px">("nomeleve2","prenomeleve2","classe2","option2")</p></i></span>

					<span>Il est recommandé d'encoder le fichier texte en UTF-8.</span>

					<br/><br/>

					<input type="submit" name="upload" value="Envoyer">
				</form>

				<!-- TRAITEMENT FICHIER CLASSE -->

				<?php

					if(!empty($_POST['upload'])) {																// Verifie si le formulaire est envoyé

						$tmp_file = $_FILES['import']['tmp_name']; 													// Recup du nom du fichier
						$file = $_FILES['import']['name'];		  													// Recup du nom et de l'extension du fichier

						if(move_uploaded_file($tmp_file, $file)) { 													// Verifie si le fichier est bien présent
						    echo '<h4 style="color:green;">Upload effectué avec succès !</h4>';
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
						    echo '<h4 style="color:red;">Echec de l\'upload !</h4>';
						}
					}

				?>

		<br/><br/><br/><br/>

		<hr width="65%">
		<hr width="65%">

		<!--                    -->
		<!-- SUPPRESSION CLASSE -->
		<!--                    -->

				<h3>Suppression classe</h3>

				<span>Choisissez la classe puis appuyez sur Supprimer.</span>

				<br/><br/>

				<form method="POST" action="#">
					
					<select name="supp_classe">
						<?php

							$sel_classe = $bdd->query('SELECT DISTINCT classe FROM elevesio ORDER BY classe ASC');

							while ($don_classe = $sel_classe->fetch()) {
								echo '<option value="'.$don_classe['classe'].'">'.$don_classe['classe'].'</option>';
							}

						?>
					</select>

					<input type="submit" value="Supprimer" name="classup"/>

				</form>

				<?php

					if(!empty($_POST['classup'])) {
						$bdd->query('DELETE FROM elevesio WHERE classe="'.$_POST['supp_classe'].'"');
						echo '<h4 style="color:green;">La classe a bien été supprimée de la BDD.</h4>';
					}

				?>

		<br/><br/><br/><br/>

		<a href="index.php"><input type="button" value="RETOUR A L'INDEX" name="Index"></a>

		<footer>
			<hr>
			<i><b>JACQUEMIN BENJAMIN</b><br/>(benjamin.jacquemin@orange.fr)</i>
		</footer>
	</body>
</html>

