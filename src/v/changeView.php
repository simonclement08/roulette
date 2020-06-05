<?php
    $title = 'AJOUT - Tirage';

    ob_start();

if(isset($_POST['message'])){
    echo $_POST['message'];
}
?>

<button class="button_back"><a href="index.php"><img class="img_menu" src="public/img/back.png" alt="retour"></a></button>

<!--             -->
<!--  New view   -->
<!--             -->
<form method="POST" action="#">
    <input class="menu_setting" type="submit" value="Gestion classe" name="set_classe">
    <input class="menu_setting" type="submit" value="Gestion étudiants" name="set_student">
</fomr>
<br>
<?php

if(!isset($_POST["set_student"]) or isset($_POST["set_classe"]) or $test){
    ?>

    <!--             -->
    <!--  AUTO FEED  -->
    <!--             -->

    <div class="content">
        <h3>Ajout de valeurs d'exemples avec une classe "TEST"</h3>
    </div>

    <form method="POST" action="#">
        <input type="submit" value="Valider" name="autofeed">
    </form><br/>

    <hr>

    <!--              -->
    <!--  AJOUT LDAP  -->
    <!--              -->

    <div class="content">
        <h3>Ajout de classe avec LDAP</h3>
        <form method="POST">
            <table>
                <tr>
                    <td class="ldap_td"><label>Hôte : </label></td>
                    <td class="ldap_input"><input required type="text" name="ldap_host" value="172.26.0.13"></td>
                </tr>
                <tr>
                    <td class="ldap_td"><label>Port : </label></td>
                    <td class="ldap_input"><input required type="text" name="ldap_port" value="389"></td>
                </tr>
                <tr>
                    <td class="ldap_td"><label>Dn : </label></td>
                    <td class="ldap_input"><input required type="text" name="ldap_dn" value="dc=ldap,dc=egnom,dc=pro"></td>
                </tr>
            </table>
            <input type="submit" value="Valider" name="ldap_config">
        </form>
        <br/>
        <?php
        if(isset($_POST["ldap_config"])){
            $ldap['dn'] = $_POST["ldap_dn"];
            $ldap['ldaphost'] = "ldap://" . $_POST["ldap_host"];
            $ldap['ldapport'] = $_POST["ldap_port"];
            $ldap['ldapuri'] = $ldap['ldaphost'] . ":" . $ldap['ldapport'];
            $ldap['manager'] = $manager;
            $LdapManager = new LdapManager($ldap);
            if(ldap_connect($ldap['ldapuri'])){
                ?>
                <form method="POST">
                    <label>Choisir la classe : </label>
                    <select name="classeSelected">
                        <?php
                            $LdapManager->groups();
                        ?>
                    </select>
                    <input type="hidden" name="ldap_host" value=<?=$LdapManager->getLdaphost()?>>
                    <input type="hidden" name="ldap_port" value=<?=$LdapManager->getLdapPort()?>>
                    <input type="hidden" name="ldap_uri" value=<?=$LdapManager->getLdapuri()?>>
                    <input type="hidden" name="ldap_dn" value=<?=$LdapManager->getDn()?>>
                    <input type="submit" value="Importer" name="LDAP"/>
                </form>
                <?php
            }
            else{
                echo "<span>Connection impossible au serveur LDAP</span>";
            }
        }
        ?>
    </div>

    <hr>

    <!--              -->
    <!-- AJOUT CLASSE -->
    <!--              -->

    <?php
    $test = $manager->getDb('*');
	$count = 0;
	foreach($test as $test){
		$count = $count + 1;
	}
	if($count === 0) {
		echo '<h4 class="warning">Aucune classe n\'a été ajouté, veuillez en ajouter une !</h4>';
	}
    ?>

    <div class="content">

        <h3>Ajout de classe par import fichier texte</h3>

        <form method="post" action="#" enctype="multipart/form-data">
            <input type="file" name="import" class="bouton">

            <p>Insérez votre fichier au format .txt contenant la classe souhaitée.</p>
            <p>Il doit se présenter sous la forme:</p>

            <i><p class="format">("nomeleve","prenomeleve","classe"),</p>
            <p class="format">("nomeleve2","prenomeleve2","classe2")</p></i>

            <p>Il est recommandé d'encoder le fichier texte en UTF-8.</p>

            <input type="submit" name="upload" value="Importer">
        </form>
    </div>
    <hr>

    <!--                    -->
    <!-- SUPPRESSION CLASSE -->
    <!--                    -->
    <div class="content">
        <h3>Suppression classe</h3>

        <p>Choisissez la classe puis appuyez sur Supprimer.<p>

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
    </div>
    <?php
}

if(isset($_POST["set_student"]) and !isset($_POST["set_classe"]) and !$test){
    ?>
    <form method="POST" action="#">
        <label>Choisir la classe : </label>
        <input type="hidden" name="set_student">
        <select name="select_classe" id="select_classe">
            <?php
                $classe = $manager->getDb('DISTINCT class','ldap = 0','class');
                foreach($classe as $element)
                {		
                    // on affiche la liste des différentes classes
                    echo "<option name='classe_eleve' value=".$element['class'].">".$element['class']."</option>";	//Affichage des classes dans un menu déroulant
                }
                if(isset($_POST['select_classe'])){
                    $_SESSION['select_classe'] = $_POST['select_classe'];		//On définit cette variable pour simplifier le code plus tard
                }
            ?>
        </select>
        <input type="submit" value="Valider" name="Validation"/>
    </form>
    
    <?php
    if(isset($_POST["Validation"])){
        ?>
        <!--             -->
        <!-- AJOUT ELEVE -->
        <!--             -->

        <div class="content">
            <h3>Ajout d'un élève</h3>

            <p>Remplissez les informations nécéssaires, puis appuyez sur Ajouter.</p>

            <form method="POST" action="#">
                <input type="hidden" name="set_student">
                <input type="hidden" name="Validation">
                <p>Nom : </p>
                <input class="add_input" type="text" name="addnom">
                <p>Prénom : </p>
                <input class="add_input" type="text" name="addprenom">
                <input type="hidden" name="select_classe" value=<?=$_SESSION['select_classe']?>><br/>
                <input type="submit" value="Ajouter" name="add">
            </form><br/>
        </div>

        <hr>

        <!--                   -->
        <!-- SUPPRESSION ELEVE -->
        <!--                   -->

        <div class="content">
            <h3>Suppression d'un élève</h3>
            <p>Choisissez la classe en appuyant sur Choix, puis l'élève, et appuyez sur Supprimer.<p>
            <form method="POST" action="#">
                <input type="hidden" name="set_student">
                <input type="hidden" name="Validation">
                <input type="hidden" name="select_classe" value=<?=$_SESSION['select_classe']?>>
                <select name="listemod">
                    <?php
                        $liste = $manager->getDb('*','class="' . $_SESSION['select_classe'] . '"');
                        while ($donnees2 = $liste->fetch()) {
                            $objet = new Student($donnees2);
                            $object = serialize($objet);
                            $object = urlencode($object);
                            echo  '<option value="' . $object . '"> ' . $objet->getFirstname() . ' ' . $objet->getSurname() . '</option>';
                        }
                    ?>
                </select>
                <input type="submit" value="Supprimer" name="del">
            </form>
        </div>

        <?php
    }
}

$content = ob_get_clean();

require 'src/v/template.php';
?>