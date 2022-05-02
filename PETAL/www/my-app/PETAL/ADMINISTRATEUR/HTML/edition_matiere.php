<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/edition_matiere_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/edition_matiere_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'une matiere</title>
</head>
<body>
<?php include("../../ALL/HTML/bandeau.php");?>
<div id="content">
    <div id="title">
        <h1>Ajout de matières</h1>
    </div>
    <form>
        <table>
            <tr>
                <td colspan="2">
                    <label for="titreMatiere">Nom de la matière</label></br>
                    <input type="text" id="titreMatiere"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Image</label></br>
                    <input type="button" id="ajoutFichier" value="" onclick="AjoutImageFichier()"/>
                    <input type="hidden" id="b64Image" name="b64Image" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Valider" id="valider">
                </td>
                <td>
                    <input type="button" value="Annuler" id="annuler" onClick="window.location.href='gestion_matiere.php'">
                </td>
            </tr>
        </table>
    </form>
</div>
<script src="../../ADMINISTRATEUR/JS/edition_matiere.js"></script>
</body>
</html>
