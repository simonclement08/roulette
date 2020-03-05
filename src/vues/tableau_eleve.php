<?php session_start();?>
<!DOCTYPE HTML>
	<html>
		<head>
		
			<meta charset="utf-8"/>
			<title>Monge Roulette</title>
			<link rel="stylesheet" href="./styles/style.css">

		</head>
<!--Code PHP développé par Geoffrey KALUZNY, élève de BTS SIO 1ère année -->
<body>
<!--Cette page contiendra uniquement la requête à la base de données, elle affichera une liste d'élève en fontion de la classe sélectionné par le professeur dans le menu principal -->
<?php include "menu.html";?>



<?php
try
{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=PROJECT_ROULETTE;charset=utf8', 'PROJECT_ROULETTE', 'PROJECT_ROULETTE');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

include('action.php');
?>
<h1>SIO ROULETTE</h1>

<form method="POST" action="#">
	<input type="submit" value="Tirer" name="tirer">
	<input type="submit" value="Moins de passage" name="pass" >
	<input type="submit" value="Plus petite moyenne" name="petitm">
	<input type="submit" value="Plus grande moyenne" name="grandm">
	<input type="submit" value="Reset passages" name="Resetpass">
	<input type="submit" value="Reset tout" name="Resetall">
</form><br/>

<?php 

	//fonction tirer qui se situe dans action.php
  if(!empty($_POST['tirer'])) {
  echo Tirer();
  }
  	//fonction RESET PASSAGE, pour seulement reset les passages et non les moyennes, absences etc...
  if (isset($_POST['Resetpass'])) {
  $bdd->query('UPDATE elevesio SET bool= 0 WHERE classe="'.$_POST['select_classe'].'"');
  }
  	//fonction RESET ALL, pour remettre à 0 tout (passages, moyennes, notes, absences etc...)
  if (isset($_POST['Resetall'])) {
  $bdd->query('UPDATE elevesio SET bool= 0, nbpassage= "", absence= "", noteaddition= "", notetotale= "", moyenne= "" WHERE classe="'.$_POST['select_classe'].'"');
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
    $sql = 'SELECT COUNT(*) AS nb FROM elevesio WHERE bool=1 AND classe="'.$_POST['select_classe'].'"';
    $result = $bdd->query($sql);
    $columns = $result->fetch(PDO::FETCH_BOTH);          
    $nb = $columns['nb'];

    $sql = 'SELECT COUNT(*) AS nb FROM elevesio WHERE classe="'.$_POST['select_classe'].'"';
    $result = $bdd->query($sql);
    $columns = $result->fetch(PDO::FETCH_BOTH);
    $nb2 = $columns['nb'];
    
    echo ' Il y a <b>'.$nb.'</b> sur <b>'.$nb2.'</b> étudiants tirés au sort !<br />';
	
	
?>
<br/>

</div>

<div class="liste">

	<form method="POST" >
		<a href="modification.php"><input type="button" value="Ajout/Suppression Etudiant" name="Modification"></a>
	</form><br/>
			<?php 
				
			//	$bdd = new PDO('mysql:host=localhost;dbname=PROJECT_ROULETTE;charset=utf8', 'PROJECT_ROULETTE', 'PROJECT_ROULETTE');	

				$liste = $bdd->query('SELECT nom, prenom, section FROM elevesio WHERE bool=0 AND classe="'.$_POST['select_classe'].'"');

					while ($donnees2 = $liste->fetch())
					{
						echo  $donnees2['nom'] ." ". $donnees2['prenom'] ." (". $donnees2['section'].")<br/>" ;
					}
				
			?>
<br>
<br>

<?php include "pied.html";?>
</body>
</html>