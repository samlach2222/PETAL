<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/edition_admin_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/edition_admin_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'un administrateur</title>
</head>
<body>
<?php
    include("../../ALL/HTML/bandeau.html");
    include("../PHP/script_edition_admin.php");
?>
<div id="content">
    <div id="title">
        <h1 id="createAdmin">Edition d'un administrateur</h1>
    </div>
    <form action="../PHP/script_edition_admin.php" method="post">
        <table>
            <tr>
                <td colspan="2" >
                    <input type="button" id="ajoutImageProfil" value="" onclick="AjoutImageProfil()"/>
                    <input type="hidden" id="b64Image" name="b64Image" value="<?php if(isset($photoProfilB64)) {echo $photoProfilB64;} ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenomAdmin">Prénom</label></br>
                    <input type="text" required id="prenomAdmin" name="prenomAdmin" value="<?php if(isset($prenomAdmin)) {echo $prenomAdmin;} ?>"/>
                </td>
                <td>
                    <label for="nomAdmin">Nom</label></br>
                    <input type="text" required id="nomAdmin" name="nomAdmin" value="<?php if(isset($nomAdmin)) {echo $nomAdmin;} ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="passAdmin">Mot de passe</label></br>
                    <input type="password" required id="passAdmin" name="passAdmin" value="<?php if(isset($passAdmin)) {echo $passAdmin;} ?>"/>
                </td>
                <td>
                    <label for="mailAdmin">Adresse mail</label></br>
                    <input type="email" required id="mailAdmin" name="mailAdmin" value="<?php if(isset($mailAdmin)) {echo $mailAdmin;} ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="telAdmin">N°Téléphone (facultatif)</label></br>
                    <input type="tel" id="telAdmin" name="telAdmin" value="<?php if(isset($telAdmin)) {echo $telAdmin;} ?>"/>
                </td>
                <?php
                if(empty($_GET['id'])) {
                    echo '<td>
                            <label for="numAdmin">N°Administrateur</label></br>
                            <input type="text" required id="numAdmin" name="numAdmin"/>
                        </td>';
                }
                ?>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="valider" value="Valider" id="valider">
                </td>
                <td>
                    <input type="button" value="Annuler" id="annuler" onClick="window.location.href='gestion_utilisateurs.php'">
                </td>
            </tr>
        </table>
    </form>
</div>
<script src="../../ADMINISTRATEUR/JS/edition_admin.js"></script>
</body>
</html>
