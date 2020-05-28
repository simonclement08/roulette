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
            echo '<option value="' . $don_classe['class'] . '">' . $don_classe['class'] . '</option>';
        }
        ?>
    </select>

    <input type="submit" value="Supprimer" name="classup"/>
</form>

<br/><br/><br/><br/>

<hr>
<hr>