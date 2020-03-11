<?php
// On enregistre notre autoload.
function chargerClasse($classname){
	require 'model/' . $classname.'.php';
}
spl_autoload_register('chargerClasse');

session_start();

if (isset($_GET['action'])){
    if ($_GET['action'] == 'change'){
        require 'controller/changeController.php';
    }
	else{
		require 'controller/homepageController.php';
	}
}
else {
    require 'controller/homepageController.php';
}
