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
				echo "<option name='classe_eleve' value=" . $element['class'] . ">" . $element['class'] . "</option>";	//Affichage des classes dans un menu déroulant
			}
			$_SESSION['select_classe'] = $_POST['select_classe'];		//On définit cette variable pour simplifier le code plus tard
		?>
	</select>
	<?php
	if($_SESSION['select_classe']){
		?>
		<select name="select_section" id="select_section">
			<?php
				$classe = $manager->getDb('DISTINCT section','class = "' . $_SESSION['select_classe'] . '"','section');
				echo "<option name='section_eleve' value=" . null . "></option>";
				foreach($classe as $element)
				{		
					// on affiche la liste des différentes sections
					echo "<option name='section_eleve' value=" . $element['section'] . ">" . $element['section'] . "</option>";
				}
				$_SESSION['select_section'] = $_POST['select_section'];		//On définit cette variable pour simplifier le code plus tard
			?>
		</select>
		<?php
	}
	?>
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
if(!empty($_POST['tirer'])) {
    echo Tirer($manager);
}

//fonction Pass qui se situe dans function.php
if(!empty($_POST['pass'])) {
    echo Pass($manager);
}

//Appelle de la fonction Moyless dans le fichier action.php
if (isset($_POST['petitm'])) {
    echo Moyless($manager);
}
//Appelle de la fonction Moyhigh dans le fichier action.php
if (isset($_POST['grandm'])) {
    echo Moyhigh($manager);
}

//Requete pour récupérer le nombre d'élèves passés sur le nombre total d'élèves.

$where = 'bool=1 AND class = "' . $_SESSION['select_classe'] . '"';
if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
$sql = $manager->getDb('COUNT(*) AS nb', $where);
$columns = $sql->fetch(PDO::FETCH_ASSOC);
$nb = $columns['nb'];

$where = 'class="'.$_SESSION['select_classe'].'"';
if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';        
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
		$where = 'bool=0 AND class = "' . $_SESSION['select_classe'] . '"';
		if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
		$liste = $manager->getDb('surname, firstname, section',$where);
		$select = $manager->getDb('DISTINCT class', null, 'class ASC');
		$select2 = $manager->getDb('DISTINCT section','class = "'. $_SESSION['select_classe'] . '"', 'section ASC');
		$var = 0;
		$var2 = 1;
		while ($donnees2 = $select->fetch(PDO::FETCH_BOTH))
		{
			if($_SESSION['select_classe'] == $donnees2['class']){
				echo "<script>document.getElementById('select_classe').selectedIndex='" . $var . "'</script>";	//Focus sur la classe dans le menu déroulant
			}
			$var = $var + 1;
		}
		while ($donnees2 = $select2->fetch(PDO::FETCH_BOTH))
		{
			if($_SESSION['select_section'] == $donnees2['section']){
				echo "<script>document.getElementById('select_section').selectedIndex='" . $var2 . "'</script>";	//Focus sur la section dans le menu déroulant
			}
			$var2 = $var2 + 1;
		}
		while ($donnees2 = $liste->fetch(PDO::FETCH_BOTH))
		{
			echo  $donnees2['surname'] ." ". $donnees2['firstname'] ." (". $donnees2['section'].")<br/>" ;
		}
	}
	?>
</div>

<?php
$content = ob_get_clean();

require 'src/v/template.php';
?>