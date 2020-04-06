<?php
    $title = 'Tirage';

	ob_start();	
?>

<h1>SIO ROULETTE</h1>

<form method="POST" action="#">

	<select name="select_classe" id="select_classe">
		<?php
			$classe = $manager->getDb('DISTINCT class',null,'class');
			foreach($classe as $element)
			{		
				// on affiche la liste des différentes classes
				echo "<option name='classe_eleve' value=".$element['class'].">".$element['class']."</option>";	//Affichage des classes dans un menu déroulant
			}

			$_SESSION['select_classe'] = $_POST['select_classe'];		//On définit cette variable pour simplifier le code plus tard
		?>
	</select>
	
	<input type="submit" value="Choisir Classe" name="Validation"/>
	
	<br/><br/>
	
	<input type="submit" value="Tirer" name="tirer">
	<input type="submit" value="Moins de passage" name="pass" >
	<input type="submit" value="Plus petite moyenne" name="petitm">
	<input type="submit" value="Plus grande moyenne" name="grandm">
	<input type="submit" value="Reset passages" name="Resetpass">
	<input id="resetall" type="submit" value="Reset tout" name="Resetall">
</form>

<br/>

<?php

//fonction tirer qui se situe dans function.php
if(isset($_POST['tirer'])) {
    Tirer($manager,$_POST['select_classe']);
}

//fonction Pass qui se situe dans function.php
if(isset($_POST['pass'])) {
    Pass($manager,$_POST['select_classe']);
}

//Appelle de la fonction Moyless dans le fichier action.php
if (isset($_POST['petitm'])) {
    Moyless($manager);
}
//Appelle de la fonction Moyhigh dans le fichier action.php
if (isset($_POST['grandm'])) {
    Moyhigh($manager);
}

//Requete pour récupérer le nombre d'élèves passés sur le nombre total d'élèves.

$sql = $manager->getDb('COUNT(*) AS nb','bool=1 AND class="'.$_SESSION['select_classe'].'"');
$columns = $sql->fetch(PDO::FETCH_ASSOC);
$nb = $columns['nb'];

$where = 'class="'.$_SESSION['select_classe'].'"';        
$sql = $manager->getDb('COUNT(*) AS nb',$where);
$columns = $sql->fetch(PDO::FETCH_ASSOC);
$nb2 = $columns['nb'];

echo ' Il y a <b>'.$nb.'</b> sur <b>'.$nb2.'</b> étudiants tirés au sort !<br />';
//var_dump($_SESSION);
?>
<br/>

<div class="liste">
	<!-- Bouton renvoie vers la page de gestion des étudiants AJOUT/SUPPRESSION-->
	<form method="POST" >
		<a href="index.php?action=change"><input type="button" value="Ajout et suppression" name="Modification"></a>
	</form><br/>
	<?php
	//Liste de tous les élèves sur la gauche de l'écran. (Les élèves déjà passés se retirent de la liste automatiquement)
    if(isset($_SESSION['select_classe']))
	{
		$liste = $manager->getDb('surname, firstname','bool=0 AND class="'. $_SESSION['select_classe'].'"');
		$select = $manager->getDb('DISTINCT class', null, 'class ASC');
		$var = 0;
		while ($donnees2 = $select->fetch(PDO::FETCH_BOTH))
		{
			if($_SESSION['select_classe'] == $donnees2['class']){
				echo "<script>document.getElementById('select_classe').selectedIndex='" . $var . "'</script>";	//Focus sur la classe dans le menu déroulant
			}
			$var = $var + 1;
		}
		while ($donnees2 = $liste->fetch(PDO::FETCH_BOTH))
		{
			echo  $donnees2['surname'] ." ". $donnees2['firstname'] . "<br/>" ;
		}
	}
	?>
</div>

<?php
$content = ob_get_clean();

require 'src/v/template.php';
?>