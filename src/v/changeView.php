<?php
    $title = 'AJOUT - Tirage';

    ob_start();
?>

<a class="titre" href="index.php"><h1>SIO ROULETTE</h1></a>
<br/><br/>
<!--             -->
<!--  AUTO FEED  -->
<!--             -->

<h3>Ajout d'un élève</h3>

<span>CLIQUEZ AFIN D'AJOUTER DES VALEURS QUI SERVIRONT D'EXEMPLES</span>

<br/><br/>

<form method="POST" action="#">
    
    <input type="submit" value="Ajouter Des Exemples" name="autofeed">
</form><br/>


<br/><br/><br/><br/>

<hr width="65%">
<hr width="65%">


<!--             -->
<!-- AJOUT ELEVE -->
<!--             -->

<h3>Ajout d'un élève</h3>

<span>Remplissez les informations nécéssaires, puis appuyez sur Ajouter.</span>

<br/><br/>

<form method="POST" action="#">
    <label>Nom: </label><input type="text" name="addnom">
    <label>Prénom: </label><input type="text" name="addprenom" >
    <label>Classe </label><input type="text" name="addclasse">
    <label>Section: </label><input type="text" name="addsection">
    <input type="submit" value="Ajouter" name="add">
</form><br/>


<br/><br/><br/><br/>

<hr width="65%">
<hr width="65%">

<!--                   -->
<!-- SUPPRESSION ELEVE -->
<!--                   -->

<h3>Suppression d'un élève</h3>

<span>Choisissez la classe en appuyant sur Choix, puis l'élève, et appuyez sur Supprimer.</span>

<br/><br/>

<!-- Premier formulaire de selection de classe -->

<form method="POST" action="#">
    <select name="sel_classe">
        <?php
        $sel_classe = $manager->getDb('DISTINCT class',null,'class ASC');

        while ($don_classe = $sel_classe->fetch()) {
            echo '<option value="'.$don_classe['class'].'">'.$don_classe['class'].'</option>';
        }

        ?>
    </select>
    <input type="submit" value="Choix" name="choix">
</form>

<!-- Second formulaire de selection de l'élève à supprimer -->

<form method="POST" action="#">
    <select name="listemod">
        <?php
        if (!empty($_POST['choix'])) {
            $liste = $manager->getDb('*','class="'.$_POST['sel_classe'].'"');
            while ($donnees2 = $liste->fetch()) {
                $objet = new Student($donnees2);
                $object = serialize($objet);
                $object = urlencode($object);
                echo  '<option value="'. $object .'"> '. $objet->getFirstname() . ' '. $objet->getSurname(). '</option>';
            }
        }
        ?>
    </select>

    <input type="submit" value="Supprimer" name="del">
</form>

<br/><br/><br/><br/>

<hr width="65%">
<hr width="65%">

<!--              -->
<!-- AJOUT CLASSE -->
<!--              -->

<h3>Ajout classe</h3>

<form method="post" action="#" enctype="multipart/form-data">

    <input type="file" name="import" class="bouton">

    <br/><br/>

    <span>Insérez votre fichier au format .txt contenant la classe souhaitée.<br/>
    Il doit se présenter sous la forme:<br/>

    <i><p style="text-indent:20px">("nomeleve","prenomeleve","classe","option"),</p>
    <p style="text-indent:20px">("nomeleve2","prenomeleve2","classe2","option2")</p></i></span>

    <span>Il est recommandé d'encoder le fichier texte en UTF-8.</span>

    <br/><br/>

    <input type="submit" name="upload" value="Envoyer">
</form>

<br/><br/><br/><br/>

<hr width="65%">
<hr width="65%">

<!--                    -->
<!-- SUPPRESSION CLASSE -->
<!--                    -->

<h3>Suppression classe</h3>

<span>Choisissez la classe puis appuyez sur Supprimer.</span>

<br/><br/>

<form method="POST" action="#">
    <select name="supp_classe">
        <?php
        $sel_classe = $manager->getDb('DISTINCT class',null,'class ASC');

        while ($don_classe = $sel_classe->fetch()) {
            echo '<option value="'.$don_classe['class'].'">'.$don_classe['class'].'</option>';
        }
        ?>
    </select>

    <input type="submit" value="Supprimer" name="classup"/>
</form>

<br/><br/><br/><br/>

<a href="index.php"><input type="button" value="RETOUR A L'INDEX" name="Index"></a>

<?php
$content = ob_get_clean();

require 'src/v/template.php';
?>