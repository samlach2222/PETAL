<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/discussion_forum_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/discussion_forum_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Discussions du forum</title>
</head>
<body>
    <?php
        include("../PHP/script_discussion_forum.php");
        RedirectListeSujets();
        include("../../ALL/HTML/bandeau.php");
    ?>
    <div id="content">
        <div id="gauche-cours">
            <ul id="liste-cours">
                <?php ListeCours(); ?>
            </ul>
        </div>
        <div id="droite-sujet">
            <div id="bandeau-sujet">
                <?php BandeauHaut(); ?>
            </div>
            <div id="messages">
                <?php Messages(); ?>
            </div>
            <?php BandeauEnvoyerMessage(); ?>
        </div>
    </div>
</body>
</html>

<?php BalisesScript(); ?>
