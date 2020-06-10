<?php

function autofeed($manager,$datafeed){
	$manager->insertdata($datafeed);
	$_POST['message'] = "<h4 class='valid'>Les exemples ont bien été ajoutés</h4>";
}

function Tirer($manager, $classe,$id){
	//On récupère un élève qui n'a pas encore été tiré au sort avec la fonction RAND()
	

	$ensemble = $manager->getDb('*',"bool=false AND absence = false AND class='".$_SESSION['select_classe']."'",'RAND()','1');
    $donnees = $ensemble->fetch(PDO::FETCH_ASSOC);
	
	if($donnees or $id){
		if ($donnees['bool'] == false and $id === null){
			$object = new Student($donnees);
			$_SESSION['student'] = $object;

			//On affiche son nom, prénom puis son nombre totale de passage et sa moyenne.
			echo "<div id='student'>";
				echo  "<p class='warning'>" . $object->getSurname() . " " . $object->getFirstname() . "</p>";
			?>
				<form method="POST">
					<input type="hidden" value=<?=$classe?> name="select_classe">
					<input type="hidden" name="hand">
					<input type="submit" value="A" class="buttonstudent" name="A">
					<input type="submit" value="0" class="buttonstudent" name="Nt0">
					<input type="submit" value="1" class="buttonstudent" name="Nt1">
					<input type="submit" value="3" class="buttonstudent" name="Nt3">
					<br>
					<?php 
						if (isset($_POST['select_classe'])) {
							$_SESSION['select_classe'] = $_POST['select_classe'];
						}
					?>
				</form>
			</div>
			<?php
		}
		else{
			if($id){
				?>
				<form method="POST">
					<input type="hidden" value=<?=$classe?> name="select_classe">
					<input type="hidden" name="hand">
					<input type="hidden" value=<?=$id?> name="retour">
					<input type="submit" value="0" class="buttonstudent" name="Nt0">
					<input type="submit" value="1" class="buttonstudent" name="Nt1">
					<input type="submit" value="3" class="buttonstudent" name="Nt3">
					<br>
					<?php 
						if (isset($_POST['select_classe'])) {
							$_SESSION['select_classe'] = $_POST['select_classe'];
						}
					?>
				</form>
				<?php
			}
		}
	}
	else{
		echo "<div id='studentnull'>";
		echo "</div>";
	}
}
?>