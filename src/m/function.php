<?php

function autofeed($manager,$datafeed){
	$manager->insertdata($datafeed);
}

function Tirer($manager){
	//On récupère un élève qui n'a pas encore été tiré au sort avec la fonction RAND()
	$where = 'bool = 0 AND class = "' . $_SESSION['select_classe'] . '"';
	if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
	$ensemble = $manager->getDb('*',$where,'RAND()','1');
    $donnees = $ensemble->fetch(PDO::FETCH_ASSOC);
	//while ($datacom = $sqlcom->fetch(PDO::FETCH_ASSOC)) {
	$object = new Student($donnees);

	//on ajoute +1 pour dire qu'il a été tiré au sort.
	$bool = $object->getBool();
	$passage = $object->getPassage();
	$object->setBool($bool + 1);
	$object->setPassage($passage + 1);

	$manager->update($object);

	$_SESSION['student'] = $object;
    
    if ($donnees['bool'] == 0){
		//On affiche son nom, prénom, section puis son nombre totale de passage et sa moyenne.
		echo  "<br/><b><a style=\"color:red\">". $object->getSurname() . " " . $object->getFirstname() . "</a></b><br/>". $object->getSection() . "<br/>";
		
		$testpassage = $donnees['passage'];
		$nbabsence = $donnees['absence'];
		$nbmoyenne = $donnees['average'];
		$nbtotale = $donnees['notetotal'];

		if($testpassage == 0){
			echo  "<br/><b>Nombre de passages :</b> - <br/>";
		}
		else{
			echo  "<br/><b>Nombre de passages :</b> ". $donnees['passage'] ."<br/>";
		}

		if($nbabsence == 0){
			echo  "<b>Absence(s) :</b> - <br/>";
		}
		else {
			echo  "<b>Absence(s) :</b> ". $donnees['absence'] . "<br/>";
		}
		
		if($nbmoyenne == 0 && $nbtotale == 0){
			echo  "<b>Moyenne des réponses :</b> - <br/>";
		}
		else{
			echo  "<b>Moyenne des réponses :</b> ". $donnees['average'] . " (" . $donnees['notetotal'] . ")<br/>";
		}

		?>
		<br/>
		<form method="POST" >
			<input type="submit" value="A" name="A">
			<input type="submit" value="0" name="Nt0">
			<input type="submit" value="1" name="Nt1">
			<input type="submit" value="3" name="Nt3">
			<br>
			<input type="submit" value="laisser" name="laisser" style="display:none">
			<input type="submit" value="retirer" name="retirer" style="display:none">
		</form><br/>
		<?php
    }
}

function Pass($manager) {
	//On prend un élève qui a le moins de passage à son compteur.
	$where = 'class = "' . $_SESSION['select_classe'] . '"';
	if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
	$ensemble = $manager->getDb('*',$where,'passage ASC','0,1');
    $donnees = $ensemble->fetch(PDO::FETCH_ASSOC);
	$object = new Student($donnees);
    //On affiche son nom, prénom, section puis son nombre total de passage et sa moyenne.
    echo  "<br/><b><a style=\"color:red\">". $object->getSurname() . " " . $object->getFirstname() . "</a></b><br/>". $object->getSection() . "<br/>";
	$testpassage = $object->getPassage();
	$nbabsence = $object->getAbsence();
	$moyenne = $object->getAverage();
	$nbtotale = $object->getNotetotal();

	if ($testpassage == 0) {
		echo  "<br/><b>Nombre de passages :</b> - <br/>";
	}
	else{
		echo  "<br/><b>Nombre de passages :</b> ". $testpassage ."<br/>";
	}

	if ($nbabsence == 0) {
		echo  "<b>Absence(s) :</b> - <br/>";
	}
	else{
		echo  "<b>Absence(s) :</b> ". $nbabsence . "<br/>";
	}
	
	if ($moyenne == 0 && $nbtotale == 0) {
		echo  "<b>Moyenne des réponses :</b> - <br/>";
	}
	else{
		echo  "<b>Moyenne des réponses :</b> ". $moyenne . " (" . $nbtotale . "note(s) )<br/>";
	}
	
    //On ajoute +1 pour dire qu'il est passé.
	$id = $object->getId();
	$object->setPassage($testpassage + 1);
    $manager->update($object);
	?>
	<br/>
	<form method="POST" >
		<input type="submit" value="A" name="A">
		<input type="submit" value="0" name="Nt0">
		<input type="submit" value="1" name="Nt1">
		<input type="submit" value="3" name="Nt3">
	</form><br/>
	<?php	
}

function Moyless($manager) {
	$where = 'notetotal > 0 AND class = "' . $_SESSION['select_classe'] . '"';
	if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
	$test = $manager->getDb('*',$where);
	$test = $test->fetch();
	if(!$test){
		echo "Aucune note a été enregistrée</br></br>";	
	}
	else{
		//On prend un élève qui a la moyenne la plus basse.
		$where = "average = (SELECT MIN( average ) FROM student) AND class = '" . $_SESSION['select_classe'] . "'";
		if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
		$ensemble = $manager->getDb("average, GROUP_CONCAT('<br>', surname, ' ', firstname ORDER BY surname ) AS 'Eleves'",$where);
		while($donnees2 = $ensemble->fetch())
		{
			echo "<b>La plus petite moyenne est de :</b> ". $donnees2['average']." <i> ".$donnees2['Eleves']." </i><br/></br>";
		}
	}
}

function Moyhigh($manager) {
	$where = 'notetotal > 0 AND class = "' . $_SESSION['select_classe'] . '"';
	if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
	$test = $manager->getDb('*',$where);
	$test = $test->fetch();
	if(!$test){
		echo "Aucune note a été enregistrée</br></br>";	
	}
	else{
		//On prend un élève qui a la moyenne la plus haute.
		$where = "average = (SELECT MAX( average ) FROM student) AND class = '" . $_SESSION['select_classe'] . "'";
		if($_SESSION['select_section'])$where = $where . 'AND section = "' . $_SESSION['select_section'] . '"';
		$ensemble = $manager->getDb("average, GROUP_CONCAT('<br>', surname, ' ', firstname ORDER BY surname ) AS 'Eleves'",$where);
		while($donnees2 = $ensemble->fetch())
		{
			echo "<b>La plus grande moyenne est de :</b> ". $donnees2['average']." <i> <a style=\"color:red\">".$donnees2['Eleves']."</a> </i><br/><br/>";
		}
	}
}
?>