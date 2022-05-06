<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/edition_cours_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/edition_cours_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'un cours</title>
</head>
<body>
<?php include("../../ALL/HTML/bandeau.php");
include("../PHP/script_edition_cours.php");?>
<div id="content">
    <div id="title">
        <h1 id="createAdmin">Ajout de cours</h1>
    </div>
    <form>
        <table>
            <?php AffichageEdition(); ?>
            <tr>
                <td>
                    <input type="submit" name="valider" value="Valider" id="valider">
                </td>
                <td>
                    <input type="button" name="annuler" value="Annuler" id="annuler" onClick="window.location.href='gestion_cours.php'">
                </td>
            </tr>
        </table>
    </form>
</div>
<script src="../../ADMINISTRATEUR/JS/edition_cours.js"></script>
</body>
</html>
