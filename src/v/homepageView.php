<?php
    $title = 'ROULETTE';

	ob_start();	
?>

<button id="button_setting"><a href="index.php?action=change"><img class="img_menu" src="public/img/setting.png" alt="setting"></a></button>

<form method="POST" action="#">
	<label>Choisir la classe : </label>
	<select name="select_classe" id="select_classe">
		<?php
			$classe = $manager->getDb('DISTINCT class',null,'class');
			foreach($classe as $element)
			{		
				// on affiche la liste des différentes classes
				echo "<option name='classe_eleve' value=".$element['class'].">".$element['class']."</option>";	//Affichage des classes dans un menu déroulant
			}
			if(isset($_POST['select_classe'])){
				$_SESSION['select_classe'] = $_POST['select_classe'];		//On définit cette variable pour simplifier le code plus tard
			}
		?>
	</select>
	
	<input type="submit" value="Valider" name="Validation"/>
	<br/>
	<hr>
	<br/>
	<?php
	if(isset($_POST['home'])){
		echo '<button class="button_menu active" name="home"><img class="img_menu" src="public/img/home.png" alt="home"></button>';
	}else{
		echo '<button class="button_menu" name="home"><img class="img_menu" src="public/img/home.png" alt="home"></button>';
	}
	if(isset($_POST['hand'])){
		echo '<button class="button_menu active" name="hand"><img class="img_menu" src="public/img/hand.png" alt="hand"></button>';
	}else{
		echo '<button class="button_menu" name="hand"><img class="img_menu" src="public/img/hand.png" alt="hand"></button>';
	}
	if(isset($_POST['reset'])){
		echo '<button class="button_menu active" name="reset"><img class="img_menu" src="public/img/reset.png" alt="reset"></button>';
	}else{
		echo '<button class="button_menu" name="reset"><img class="img_menu" src="public/img/reset.png" alt="reset"></button>';
	}
	?>
</form>

<br/>
<?php
if(isset($_SESSION['select_classe'])) {
	$liste1 = $manager->getDb('surname, firstname, average','class="'. $_SESSION['select_classe'].'"','surname,firstname');
	$liste2 = $manager->getDb('surname, firstname, average','class="'. $_SESSION['select_classe'].'"','average DESC');
	$select = $manager->getDb('DISTINCT class', null, 'class ASC');
	$var = 0;
	while ($donnees2 = $select->fetch(PDO::FETCH_BOTH)) {
		if($_SESSION['select_classe'] == $donnees2['class']) {
			echo "<script>document.getElementById('select_classe').selectedIndex='" . $var . "'</script>";	//Focus sur la classe dans le menu déroulant
		}
		$var = $var + 1;
	}
	$classe = $_SESSION['select_classe'];
}
// or (empty($_POST['hand']) and empty($_POST['reset']))
if(isset($_POST['home'])) {
?>

<table class="table">
	<caption>Moyenne / Nom</caption>
	<thead>
		<tr class="table">
			<th class="table">Nom</th>
			<th class="table">Moyenne</th>
		</tr class="table">
	</thead>
	<tbody>
		<?php
		while ($donnees2 = $liste1->fetch(PDO::FETCH_BOTH)) {
			echo "<tr class='table'>";
				echo "<td class='table'>" . $donnees2['surname'] . " " . $donnees2['firstname'] . "</td>" ;
				echo "<td class='table'>" . $donnees2['average'] . "</td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>
<br>

<table class="table">
	<caption>Moyenne / Valeur</caption>
	<thead>
		<tr class="table">
			<th class="table">Nom</th>
			<th class="table">Moyenne</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($donnees2 = $liste2->fetch(PDO::FETCH_BOTH)) {
			echo "<tr class='table'>";
				echo "<td class='table'>" . $donnees2['surname'] . " " . $donnees2['firstname'] . "</td>" ;
				echo "<td class='table'>" . $donnees2['average'] . "</td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>

<?php
}

if(isset($_POST['hand'])){
	//Requete pour récupérer le nombre d'élèves passés sur le nombre total d'élèves.

	$sql = $manager->getDb('COUNT(*) AS nb','class="'.$_SESSION['select_classe'].'"');
	$columns = $sql->fetch(PDO::FETCH_ASSOC);
	$nb = $columns['nb'];

	$sql = $manager->getDb('COUNT(*) AS nb','bool=true AND class="'.$_SESSION['select_classe'].'"');
	$columns = $sql->fetch(PDO::FETCH_ASSOC);
	$nb2 = $columns['nb'];
	$nb2 = $nb - $nb2;

	$sql = $manager->getDb('COUNT(*) AS nb','absence=1 AND class="'.$_SESSION['select_classe'].'"');
	$columns = $sql->fetch(PDO::FETCH_ASSOC);
	$nb3 = $columns['nb'];

	echo "<p>Il reste <b>" . $nb2 . "</b> étudiants à passer sur <b>" . $nb . "</b> dont <b>" . $nb3 . "</b> noté ABS<br /><p>";

	if($nb2 - $nb3 === 0){
		echo "<div class='content'><p>Tous les étudiants ont été tirés au sorts, veuillez réinitialiser les passages dans l'onglet prévu a cet effet</div>";
	}


	?>
	<form method="POST" action="#">
		<input type="hidden" name="hand">
		<input type="hidden" value=<?=$classe?> name="select_classe">
		<button id="tirer" name="tirer" value=1><img id="img_tirer" src="public/img/random.png" alt="random"></button>
	</form>

	<?php

	if(isset($_POST['tirer'])) {
		Tirer($manager, $_POST['select_classe'], null);
	}
	else{
		echo '<div id="studentnull"></div>';
	}

	if(isset($_POST['A'])){
		echo "<br/>L'élève est noté absent.<br/>";
	}
	elseif(isset($_POST['Nt0'])){
		echo  "<br/>L'élève a obtenu la note de \"0\".<br/>";
	}
	elseif(isset($_POST['Nt1'])){
		echo  "<br/>L'élève a obtenu la note de \"1\".<br/>";
	}
	elseif(isset($_POST['Nt3'])){
		echo  "<br/>L'élève a obtenu la note de \"3\".<br/>";
	}
	
	$select = $manager->getDb('id, surname, firstname','class="' . $classe . '" AND absence = 1');
	$stop = 0;
	while ($donnees = $select->fetch(PDO::FETCH_BOTH)){
		if($stop === 0){
			echo "<div class='content'><p> Liste des personnes précédemment tirée aux sorts et notée absent (à faire en priorité dès leur retour) :<p></div><br>";
			echo "<table>";
		}
		$stop = 1;

		echo "<tr>";
			echo "<td>";
				echo $donnees["surname"] . " " . $donnees["firstname"] . " :";
			echo "</td>";
			echo "<td>";
				Tirer($manager, $_POST['select_classe'], $donnees["id"]);
			echo "</td>";
		echo "</tr>";
	}
	?>
	</table>
	<div class="content">
		<p>Synthèse liste des étudiants :</p>
	</div>
	<?php
	$liste = $manager->getDb("surname, firstname, bool, absence","class='". $_SESSION['select_classe'] . "'","bool,absence");
	echo "<table class='table'>";
			while ($donnees = $liste->fetch(PDO::FETCH_BOTH)){
				echo "<tr class='table'>";
					if($donnees['absence'] == true){
						echo "<td>ABS - " . $donnees["surname"] . " " . $donnees["firstname"] . "</td>";
					}
					elseif($donnees['bool'] == true){
						echo "<td class='table student_note'>" . $donnees["surname"] . " " . $donnees["firstname"] . "</td>";
					}
					elseif($donnees['bool'] == false){
						echo "<td class='table'>" . $donnees["surname"] . " " . $donnees["firstname"] . "</td>";
					}
				echo "</tr>";
			}
	echo "</table>";
}

if(isset($_POST['reset'])){
	?>
	<form method="POST">
		<div class='content'>
			<input type="hidden" name="reset">
			<input type="hidden" value=<?=$classe?> name="select_classe">
			<p>Réinitialiser les passages (tous les étudiants peuvent de nouveau être tiré au sort)</p>
			<input type="submit" value="Valider" name="Resetpass">
			<p>Réinitialiser les passages + les notes</p>
		<?php
		if(isset($_POST['confirm'])){
			echo '<p>Voulez vous vraiment réinitialiser toutes les données ?</p>';
			echo '<input type="submit" value="Oui" name="Resetall">';
			echo '<input type="submit" value="Non">';
		}
		else{
			echo '<input type="submit" value="Valider" name="confirm">';
		}
		echo '</div>';
	echo "</form>";

	if (isset($_POST['Resetpass'])) {
		echo "<p>Les passages ont bien été réinitialiser</p>";
	}
	if (isset($_POST['Resetall'])) {
		echo "<p>Les passages et les notes ont bien été réinitialiser</p>";
	}
}

$content = ob_get_clean();

require 'src/v/template.php';
?>