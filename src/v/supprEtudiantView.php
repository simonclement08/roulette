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