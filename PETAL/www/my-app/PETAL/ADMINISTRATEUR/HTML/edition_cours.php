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
<?php include("../../ALL/HTML/bandeau.html");?>
<div id="content">
    <div id="title">
        <h1 id="createAdmin">Ajout de cours</h1>
    </div>
    <form>
        <table>
            <tr>
                <td>
                    <label for="titreCours">Titre du cours</label></br>
                    <input type="text" id="titreCours"/>
                </td>
                <td rowspan="3">
                    <label>Fichier</label></br>
                    <input type="button" id="ajoutFichier" value="" onclick="AjoutImage()"/>
                    <input type="hidden" id="b64Image" name="b64Image" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="typeCours">Type de cours</label></br>
                    <select name="typeCours" id="typeCours">
                        <option value="CM">CM</option>
                        <option value="TD">TD</option>
                        <option value="TP">TP</option>
                    </select>
                </td>
                
            </tr>
            <tr>
                <td>
                    <label for="nomProf">Nom du professeur</label></br>
                    <input type="text" id="nomProf"/>
                </td>
                
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Valider" id="valider">
                </td>
                <td>
                    <input type="button" value="Annuler" id="annuler" onClick="window.location.href='gestion_cours.php'">
                </td>
            </tr>
        </table>
    </form>
</div>
<script src="../../ADMINISTRATEUR/JS/edition_cours.js"></script>
</body>
</html>
