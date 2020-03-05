<?php

session_start();

include 'config/bdd.php';

function Tirer() {
	
	$bdd = connexion_bdd();

	//On récupère un élève qui n'a pas encore été tiré au sort avec la fonction RAND()
    $ensemble = $bdd->query("SELECT * FROM elevesio WHERE bool=0 AND classe='".$_SESSION['select_classe']."' ORDER BY RAND() LIMIT 1;");
    $donnees = $ensemble->fetch(PDO::FETCH_ASSOC);
	//while ($datacom = $sqlcom->fetch(PDO::FETCH_ASSOC)) {

    //on ajoute +1 pour dire qu'il a été tiré au sort.
	$bdd->query('UPDATE elevesio SET bool= bool + 1 WHERE id='.$donnees['id'].'');
	$bdd->query('UPDATE elevesio SET nbpassage= nbpassage + 1 WHERE id='.$donnees['id'].'');
	$_SESSION['id'] = $donnees['id'];
    
    	
    if ( $donnees['bool'] == 0 ){
    //On affiche son nom, prénom, section puis son nombre totale de passage et sa moyenne.
	echo  "<br/><b><a style=\"color:red\">". $donnees['nom'] . " " . $donnees['prenom'] . "</a></b><br/>". $donnees['section'] . "<br/>";
	
	$testpassage = $donnees['nbpassage'];
	$nbabsence = $donnees['absence'];
	$nbmoyenne = $donnees['moyenne'];
	$nbtotale = $donnees['notetotale'];

	if ($testpassage == 0) {
		echo  "<br/><b>Nombre de passages :</b> - <br/>";
	} else {
		echo  "<br/><b>Nombre de passages :</b> ". $donnees['nbpassage'] ."<br/>";
	}

	if ($nbabsence == 0) {
		echo  "<b>Absence(s) :</b> - <br/>";
	} else {
		echo  "<b>Absence(s) :</b> ". $donnees['absence'] . "<br/>";
	}
	
	if ($nbmoyenne == 0 && $nbtotale == 0) {
		echo  "<b>Moyenne des réponses :</b> - <br/>";
	} else {
		echo  "<b>Moyenne des réponses :</b> ". $donnees['moyenne'] . " (" . $donnees['notetotale'] . ")<br/>";
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
<?php	$ensemble->closeCursor();
	
    }
}
  
function Pass() {

	$bdd = connexion_bdd();

	//On prend un élève qui a le moins de passage à son compteur.
    $ensemble = $bdd->query('SELECT * FROM elevesio ORDER BY nbpassage ASC LIMIT 0,1');
    $donnees = $ensemble->fetch(PDO::FETCH_ASSOC);

    //On affiche son nom, prénom, section puis son nombre total de passage et sa moyenne.
    echo  "<br/><b><a style=\"color:red\">". $donnees['nom'] . " " . $donnees['prenom'] . "</a></b><br/>". $donnees['section'] . "<br/>";
	$testpassage = $donnees['nbpassage'];
	$nbabsence = $donnees['absence'];
	$nbmoyenne = $donnees['moyenne'];
	$nbtotale = $donnees['notetotale'];

	if ($testpassage == 0) {
		echo  "<br/><b>Nombre de passages :</b> - <br/>";
	} else {
		echo  "<br/><b>Nombre de passages :</b> ". $donnees['nbpassage'] ."<br/>";
	}

	if ($nbabsence == 0) {
		echo  "<b>Absence(s) :</b> - <br/>";
	} else {
		echo  "<b>Absence(s) :</b> ". $donnees['absence'] . "<br/>";
	}
	
	if ($nbmoyenne == 0 && $nbtotale == 0) {
		echo  "<b>Moyenne des réponses :</b> - <br/>";
	} else {
		echo  "<b>Moyenne des réponses :</b> ". $donnees['moyenne'] . " (" . $donnees['notetotale'] . "note(s) )<br/>";
	}
	
    //On ajoute +1 pour dire qu'il est passé.
    $ids = $donnees['id'];
    $bdd->query('UPDATE elevesio SET nbpassage= nbpassage + 1 WHERE id='.$ids.'');
    if(isset($_POST['A'])) {

    $test = $_SESSION['id'];
	$bdd->query('UPDATE elevesio SET absence= absence + 1 WHERE id='.$test);
	$bdd->query('UPDATE elevesio SET nbpassage= nbpassage - 1 WHERE id='.$test);
	}
	?>
	<br/>
<form method="POST" >
	<input type="submit" value="A" name="A">
	<input type="submit" value="0" name="Nt0">
	<input type="submit" value="1" name="Nt1">
	<input type="submit" value="3" name="Nt3">
</form><br/>
<?php	
    $ensemble->closeCursor();
}

function Moyless() {

	$bdd = connexion_bdd();

	$ensemble = $bdd->query('SELECT * FROM elevesio WHERE notetotale > 0');
    $donnees = $ensemble->fetch();

	if (empty($donnees['notetotale'])) {

		echo "Aucune note a été enregistrée</br></br>";	

	} 
	else {

    $ensemble = $bdd->query("SELECT moyenne, GROUP_CONCAT('<br>', nom, ' ', prenom ORDER BY nom ) AS 'Eleves' FROM elevesio WHERE moyenne = (SELECT MIN( moyenne ) FROM elevesio);");
   

   while($donnees2 = $ensemble->fetch())
	{
	echo "<b>La plus petite moyenne est de :</b> ". $donnees2['moyenne']." <i> ".$donnees2['Eleves']." </i><br/></br>";
    }
	}

	//On prend un élève qui a la moyenne la plus basse.
    
$ensemble->closeCursor();
}

function Moyhigh() {

	$bdd = connexion_bdd();

	$ensemble = $bdd->query('SELECT * FROM elevesio WHERE notetotale > 0');
    $donnees = $ensemble->fetch();

	if (empty($donnees['notetotale'])) {

		echo "Aucune note a été enregistrée</br></br>";	

	} 
	else {
	//On prend un élève qui a la moyenne la plus haute.
    $ensemble = $bdd->query("SELECT moyenne, GROUP_CONCAT('<br>', nom, ' ', prenom ORDER BY nom ) AS 'Eleves' FROM elevesio WHERE moyenne = (SELECT MAX( moyenne ) FROM elevesio);");  //http://www.lafabriquedecode.com/blog/2013/06/mysql-max/   <-- a regarder
    
	
	while($donnees2 = $ensemble->fetch())
	{
    
    echo "<b>La plus grande moyenne est de :</b> ". $donnees2['moyenne']." <i> <a style=\"color:red\">".$donnees2['Eleves']."</a> </i><br/><br/>";

	}
	}
	    $ensemble->closeCursor();
}
?>