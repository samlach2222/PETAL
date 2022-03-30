<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/edition_matiere_light.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'une matiere</title>
</head>
<body>
<?php include("../../ALL/HTML/bandeau.html");?>
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
                    <input type="button" id="ajoutFichier" value=""/>
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

</body>
</html>
