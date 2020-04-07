# Documentation utilisateur

## Présentation

ROULETTE est une application, conçu pour tirer au sort un élève. Cet utilitaire est destiné aux professeurs et à plusieurs fonctions.



## Fonctionnement

Rien de plus simple, la liste des élèves s’affiche devant vos yeux, il suffira de cliquer sur le bouton Tirer pour qu’un élève soit tiré au sort parmi toute la liste des élèves.
 Dès lors, l’élève qui a été tiré est retiré de la liste et ne peut pas être re-tiré encore une fois.
 (Il est bien sûr possible de réinitialiser la liste a l’aide d’un simple bouton.)
 L’élève tiré au sort doit recevoir une note de 0, 1 ou 3. Il est bien sûr possible de noter un élève absent. 

Il y a possibilité d’afficher les différentes moyennes (la plus haute, la plus basse ainsi que la moyenne de classe).

Si vous désirez remettre la liste des passages à zéro pour différentes causes, ceci est possible grâce au bouton Reset passages.

La première page visuelle est l’accueil, on y retrouve les différents boutons qui permettent de tirer au sort les élèves de la classe.

...



Pour cela vous avez le choix entre différents boutons :

​	- Tirer : Le bouton qui choisit aléatoirement dans la classe concernée une personne.

​	- Moyennes : Afficher les différentes moyennes citées au dessus

​	- Reset passages : Réinitialise les passages de toutes les classes.

​	- Reset passages (Classe) : Réinitialise les passages de la classe concernée.

​	- Reset Tout (Classe) : Réinitialise les notes, les passages, les absences de la classe concernée.

​	- Reset Tout : Réinitialise les notes, les passages, les absences de toutes les classes.



De plus elle comporte l’affichage des classes concernées :

...



**Ajouter ou supprimer un élève**

...



**Ajouter une classe (via fichier texte)**

Grâce à ce bouton et un format de fichier TXT spécifique, l’utilisateur pourra importer ses élèves sans devoir importer chaque élève un à un.

Le fichier doit être au format .txt et se présenter sous la forme:

("nomeleve",prenomeleve","classe"),
("nomeleve2",prenomeleve2","classe2"),
...
("nomeleveX",prenomeleveX","classeX")