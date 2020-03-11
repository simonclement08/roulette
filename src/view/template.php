<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="public/css/style.css" />
    </head>
        
    <body>
        <!-- Code HTML développé par Geoffrey KALUZNY, élève de SIO 1 -->

        <header>
            <div>
                <h1>MONGE ROULETTE</h1>
            </div>
        </header>


        <!-- Un menu plus simple d'utilisation et personaliser -->

        <table id="menu_but"><!--
                        
                <tr>
                    
                    <form method="POST" action="fonctions.php#">
                    
                        <td><input type="submit" class="menu" value="Tirer Au Sort"/></td>
                        
                        Bouton pour tirer un élève au sort
                        
                        <td><input type="submit" class="menu" value="Moyenne la plus haute"/></td>
                            
                        Bouton pour afficher la plus haute moyenne avec le nom et le prénom de l'élève
                        
                        <td><input type="submit" class="menu" value="Moyenne la plus basse"/></td>
                        
                        Bouton pour afficher la moyenne la plus basse avec le nom et le prénom de l'élève
                            
                        <td><input type="submit" class="menu" value="Reset"/></td>
                        
                        Remet à zéro : les notes, le nombre de passage, ...
                    
                    </form>
                    
                </tr>
                    -->	
        </table>
        
        <?= $content ?>

        <!-- Code HTML développé par Geoffrey KALUZNY -->

        <script src="public/js/script.js"></script>
    </body>
</html>