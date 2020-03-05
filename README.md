# ROULETTE

ROULETTE est une application, conçu pour tirer au sort un élève. Cet utilitaire est destiné aux enseignants.

## INSTALLATION

- Change right access to the project :
	chown -R www-data:www-data ROULETTE
- Configure the BDD :
	- import the script in your BDD : ROULETTE/src/data/ROULETTE.sql
	- change the content of : ROULETTE/src/config/bdd.php.template
	- rename ROULETTE/src/config/bdd.php.template to ROULETTE/src/config/bdd.php

## TROUBLESHOOTING
None.