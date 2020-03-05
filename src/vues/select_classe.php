<?php session_start() ?>

<div id='menu_select_classe'>
	
	<form method="POST" action='vues/tableau_eleve.php' class="selecteur">
	
		<select name="select_classe" class="classe">
			
			<?php
			// Ceci sera le template pour les requêtes de sélection en SQL
			
				$bdd = new PDO('mysql:host=localhost;dbname=PROJECT_ROULETTE;charset=utf8', 'PROJECT_ROULETTE', 'PROJECT_ROULETTE');	//connexion à la base de données
				
				$sql = 'SELECT DISTINCT classe FROM elevesio ORDER BY classe';	//requête SQL qui permet de récupérer les classes distinctes
				
				$sqlcom=$bdd->prepare($sql);	//préparation de la requête SQL
				
				$sqlcom->execute();		//éxécution de la requête SQL
				 
				while ($datacom = $sqlcom->fetch(PDO::FETCH_ASSOC)) {
					
					// on affiche la liste des différentes classes
					
					echo "<option name='classe_eleve' value=".$datacom['classe'].">".$datacom['classe']."</option>";	//Affichage des classes dans un menu déroulant
				
				}
			
			?>
			
		</select>
		
		<input type="submit" name="bouton_valider" value="Valider" id="valide_classe"/>		<!-- Envoi des informations par méthode POST -->
		
	</form>
	
</div>
