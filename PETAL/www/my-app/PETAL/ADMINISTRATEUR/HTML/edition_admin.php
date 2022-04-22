<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/edition_admin_dark.css">
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
                    <input type="hidden" id="b64Image" name="b64Image" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenomAdmin">Prénom</label></br>
                    <input type="text" id="prenomAdmin" name="prenomAdmin"/>
                </td>
                <td>
                    <label for="nomAdmin">Nom</label></br>
                    <input type="text" id="nomAdmin" name="nomAdmin"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="passAdmin">Mot de passe</label></br>
                    <input type="password" id="passAdmin" name="passAdmin"/>
                </td>
                <td>
                    <label for="mailAdmin">Adresse mail</label></br>
                    <input type="email" id="mailAdmin" name="mailAdmin"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="telAdmin">N°Téléphone (facultatif)</label></br>
                    <input type="tel" id="telAdmin" name="telAdmin"/>
                </td>
                <td>
                    <label for="numAdmin">N°Administrateur</label></br>
                    <input type="text" id="numAdmin" name="numAdmin"/>
                </td>
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
