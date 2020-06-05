<?php

	require_once 'config/connexion_sql.php';
	
	// On enregistre notre autoload.
	function chargerClasse($classname){
		require 'src/m/' . $classname.'.php';
	}
	spl_autoload_register('chargerClasse');

	session_start();

	$manager = new StudentManager($bdd);
	$test = $manager->getDb('*');
	$count = 0;
	foreach($test as $test){
		$count++;
	}
	if($count === 0) {
		$test = true;
	}
	else{
		$test = false;
	}

	if (isset($_GET['action']) || $test){
	    if ($test || $_GET['action'] == 'change'){
	        require 'src/c/changeController.php';
	    }
		else{
			require 'src/c/homepageController.php';
		}
	}
	else {
	    require 'src/c/homepageController.php';
	}
