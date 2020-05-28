<!--              -->
<!-- AJOUT CLASSE -->
<!--              -->
<?php
if($test){
    echo '<h3 class="warning">Aucune classe n\'a été ajouté, veuillez en ajouter une !</h3>';
}
?>
<h3>Ajout classe</h3>

<form method="post" action="#" enctype="multipart/form-data">

    <input type="file" name="import" class="bouton">

    <br/><br/>

    <span>Insérez votre fichier au format .txt contenant la classe souhaitée.<br/>
    Il doit se présenter sous la forme:<br/>

    <i><p class="format">("nomeleve","prenomeleve","classe"),</p>
    <p class="format">("nomeleve2","prenomeleve2","classe2")</p></i></span>

    <span>Il est recommandé d'encoder le fichier texte en UTF-8.</span>

    <br/><br/>

    <input type="submit" name="upload" value="Envoyer">
</form>

<br/><br/><br/><br/>

<hr>
<hr>