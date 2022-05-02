<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/liste_sujets_forumt_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/liste_sujets_forum_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des sujet du forum</title>
</head>
<body>
    <?php 
        include("../PHP/script_liste_sujets_forum.php");
        CreateSujet();
        include("../../ALL/HTML/bandeau.html");
    ?>
    <div id="content">
        <div id="gauche-cours">
            <ul id="liste-cours">
                <?php ListeCours(); ?>
            </ul>
        </div>
        <div id="droite-sujets">
            <?php ListeSujets(); ?>
        </div>
    </div>
</body>
</html>

<script src="../JS/liste_sujets_forum.js"></script>
