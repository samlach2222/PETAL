<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/edition_etudiant_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/edition_etudiant_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'un etudiant</title>
</head>
<body>
<?php
    include("../../ALL/HTML/bandeau.php");
    include("../PHP/script_edition_etudiant.php");
?>
    <div id="content">
        <div id="title">
            <h1 id="createAdmin">Edition d'un étudiant</h1>
        </div>
        <form action="../PHP/script_edition_etudiant.php" method="post">
            <table>
                <tr>
                    <td colspan="2" >
                        <input type="button" id="ajoutImageProfil" value="" onclick="AjoutImageProfil()"/>
                        <input type="hidden" id="b64Image" name="b64Image" value="<?php if(isset($photoProfilB64)) {echo $photoProfilB64;} ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="prenomEtu">Prénom</label></br>
                        <input type="text" required id="prenomEtu" name="prenomEtu" value="<?php if(isset($prenomEtu)) {echo $prenomEtu;} ?>" maxlength="50"/>
                    </td>
                    <td>
                        <label for="nomEtu">Nom</label></br>
                        <input type="text" required id="nomEtu" name="nomEtu" value="<?php if(isset($nomEtu)) {echo $nomEtu;} ?>" maxlength="50"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="passEtu">Mot de passe</label></br>
                        <input type="password" required id="passEtu" name="passEtu" value="<?php if(isset($passEtu)) {echo $passEtu;} ?>" maxlength="72"/>
                    </td>
                    <td>
                        <label for="mailEtu">Adresse mail</label></br>
                        <input type="email" required id="mailEtu" name="mailEtu" value="<?php if(isset($mailEtu)) {echo $mailEtu;} ?>" maxlength="75"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="telEtu">N°Téléphone (facultatif)</label></br>
                        <input type="tel" id="telEtu" name="telEtu" value="<?php if(isset($telEtu)) {echo $telEtu;} ?>" maxlength="15"/>
                    </td>
                    <?php
                        if(empty($_GET['id'])) {
                            echo '<td>
                                    <label for="numEtu">N°Etudiant</label></br>
                                    <input type="text" required id="numEtu" name="numEtu" maxlength="9"/>
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
    <script src="../../ADMINISTRATEUR/JS/edition_etudiant.js"></script>
</body>
</html>
