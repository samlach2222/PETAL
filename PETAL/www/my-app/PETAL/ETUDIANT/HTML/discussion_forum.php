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
            <div id="envoyer-message">
                <span id="envoyer-message-span">Poster un message :</span>
                <textarea id="envoyer-message-texte" maxlength="2000"></textarea>
                <button id="envoyer-message-bouton" onclick="EnvoyerMessage()">Envoyer</button>
            </div>
        </div>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../JS/discussion_forum.js"></script>
<script>SetNumeroEtudiant(<?php echo $_SESSION['num']; ?>);</script>
