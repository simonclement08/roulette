<?php

	require_once 'config/connexion_sql.php';
	
	// On enregistre notre autoload.
	function chargerClasse($classname){
		require 'src/m/' . $classname.'.php';
	}
	spl_autoload_register('chargerClasse');

	session_start();

	if (isset($_GET['action'])){
	    if ($_GET['action'] == 'change'){
	        require 'src/c/changeController.php';
	    }
		else{
			require 'src/c/homepageController.php';
		}
	}
	else {
	    require 'src/c/homepageController.php';
	}
