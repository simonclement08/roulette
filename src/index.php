<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tirage</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
</head>
<body>

<?php

include 'action.php';

	$bdd = connexion_bdd();
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<h1>SIO ROULETTE</h1>

<form method="POST" action="#">

		<select name="select_classe" id="select_classe">
		<?php
			$sql = 'SELECT DISTINCT classe FROM elevesio ORDER BY classe';	//requête SQL qui permet de récupérer les classes distinctes
				
			$sqlcom=$bdd->prepare($sql);	//préparation de la requête SQL
				
			$sqlcom->execute();		//éxécution de la requête SQL
				 
			while ($datacom = $sqlcom->fetch(PDO::FETCH_ASSOC))
			{		
				// on affiche la liste des différentes classes
					
				echo "<option name='classe_eleve' value=".$datacom['classe'].">".$datacom['classe']."</option>";	//Affichage des classes dans un menu déroulant
				
				//Intégration future des sections !!
				
			}
			$_SESSION['select_classe']=$_POST['select_classe'];		//On définit cette variable pour simplifier le code plus tard
		?>
	</select>
	
	<input type="submit" value="Choisir Classe" name="Validation"/>
	
	<br/><br/>
	
	<input type="submit" value="Tirer" name="tirer">
	<input type="submit" value="Moins de passage" name="pass" >
	<input type="submit" value="Plus petite moyenne" name="petitm">
	<input type="submit" value="Plus grande moyenne" name="grandm">
	<input type="submit" value="Reset passages" name="Resetpass">
	<input type="submit" value="Reset tout" name="Resetall" style="background-color:red;">
</form><br/>

<?php 

	//fonction tirer qui se situe dans action.php
  if(!empty($_POST['tirer'])) {
  echo Tirer();
  }
  	//fonction RESET PASSAGE, pour seulement reset les passages et non les moyennes, absences etc...
  if (isset($_POST['Resetpass'])) {
  $bdd->query('UPDATE elevesio SET bool= 0');
  }
  	//fonction RESET ALL, pour remettre à 0 tout (passages, moyennes, notes, absences etc...)
  if (isset($_POST['Resetall'])) {
  $bdd->query('UPDATE elevesio SET bool= 0, nbpassage= "", absence= "", noteaddition= "", notetotale= "", moyenne=NULL');
  }

	//fonction Pass qui se situe dans action.php
  if(!empty($_POST['pass'])) {
  echo Pass();
  }
	//Action lors du clique "A" pour les absences (ajouter +1 dans absence et -1 au passage dans la BDD vu que l'élève avait reçu un +1 lorsqu'il a été tiré au sort)
  if(isset($_POST['A'])) {

  	$test = $_SESSION['id'];
	$bdd->query('UPDATE elevesio SET absence= absence + 1 WHERE id='.$test);
	$bdd->query('UPDATE elevesio SET nbpassage= nbpassage - 1 WHERE id='.$test);
	$bdd->query('UPDATE elevesio SET bool= bool - 1 WHERE id='.$test);   // ajouter les deux autres boutons

	
	echo  "<br/>L'élève est noté absent.<br/>";
  }
  

  if(isset($_POST['Nt0'])) {

	//Action lors du clique "0" pour la note de 0. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$bdd->query('UPDATE elevesio SET noteaddition= noteaddition + 0 WHERE id='.$_SESSION['id']);
	$bdd->query('UPDATE elevesio SET notetotale= notetotale + 1 WHERE id='.$_SESSION['id']);
	$bdd->query('UPDATE elevesio SET moyenne = noteaddition/notetotale WHERE id='.$_SESSION['id']);

	echo  "<br/>L'élève a obtenu la note de \"0\".<br/>";
  }

  if(isset($_POST['Nt1'])) {

	//Action lors du clique "1" pour la note 1. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$bdd->query('UPDATE elevesio SET noteaddition= noteaddition + 1 WHERE id='.$_SESSION['id']);
	$bdd->query('UPDATE elevesio SET notetotale= notetotale + 1 WHERE id='.$_SESSION['id']);
	$bdd->query('UPDATE elevesio SET moyenne = noteaddition/notetotale WHERE id='.$_SESSION['id']);

	
	echo  "<br/>L'élève a obtenu la note de \"1\".<br/>";
  }

  if(isset($_POST['Nt3'])) {

	$donnees['id'] = $_SESSION['id'];
	//Action lors du clique "3" pour la note 3. (On l'ajoute à la colonne addition de toutes les notes et +1 dans le nombre de note afin de faire la moyenne)
	$bdd->query('UPDATE elevesio SET noteaddition= noteaddition + 3 WHERE id='.$_SESSION['id']);
	$bdd->query('UPDATE elevesio SET notetotale= notetotale + 1 WHERE id='.$_SESSION['id']);
	$bdd->query('UPDATE elevesio SET moyenne = noteaddition/notetotale WHERE id='.$_SESSION['id']);

	
	echo  "<br/>L'élève a obtenu la note de \"3\".<br/>";
  }

  //Appelle de la fonction Moyless dans le fichier action.php
  if (isset($_POST['petitm'])) {
  	echo Moyless();
  }
  //Appelle de la fonction Moyhigh dans le fichier action.php
  if (isset($_POST['grandm'])) {
  	echo Moyhigh();
  }
?>


<?php	
	//Requete pour récupérer le nombre d'élèves passés sur le nombre total d'élèves.
    $sql = 'SELECT COUNT(*) AS nb FROM elevesio WHERE bool=1 AND classe="'.$_SESSION['select_classe'].'"';
    $result = $bdd->query($sql);
    $columns = $result->fetch(PDO::FETCH_BOTH);          
    $nb = $columns['nb'];

    $sql = 'SELECT COUNT(*) AS nb FROM elevesio WHERE classe="'.$_SESSION['select_classe'].'"';
    $result = $bdd->query($sql);
    $columns = $result->fetch(PDO::FETCH_BOTH);
    $nb2 = $columns['nb'];
    
    echo ' Il y a <b>'.$nb.'</b> sur <b>'.$nb2.'</b> étudiants tirés au sort !<br />';
	
	
?>
<br/>

<div class="liste">
	<!-- Bouton renvoie vers la page de gestion des étudiants AJOUT/SUPPRESSION-->
	<form method="POST" >
		<a href="modification.php"><input type="button" value="Ajout et suppression" name="Modification"></a>
	</form><br/>
	<?php
	//Liste de tous les élèves sur la gauche de l'écran. (Les élèves déjà passés se retirent de la liste automatiquement)
if(isset($_SESSION['select_classe']))
		{
			$liste = $bdd->query('SELECT nom, prenom, section FROM elevesio WHERE bool=0 AND classe="'.$_SESSION['select_classe'].'"'); //Requête qui va récupérer les noms dans la BDD
		if ($_SESSION['select_classe']=="SIO1")
			{
			echo "<script>document.getElementById('select_classe').selectedIndex='0'</script>";	//Focus sur la classe dans le menu déroulant
			}
			else
			{
				echo "<script>document.getElementById('select_classe').selectedIndex='1'</script>";
			}
		while ($donnees2 = $liste->fetch(PDO::FETCH_BOTH))
		{
			echo  $donnees2['nom'] ." ". $donnees2['prenom'] ." (". $donnees2['section'].")<br/>" ;
		}
		}
	?>
</div>

<footer>
	<hr>
	<i><b>JACQUEMIN BENJAMIN</b><br/>(benjamin.jacquemin@orange.fr)</i>
</footer>

<script src="script.js"> </script>

</body>
</html>