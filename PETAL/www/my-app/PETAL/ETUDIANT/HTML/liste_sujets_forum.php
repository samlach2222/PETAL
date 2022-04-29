<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/liste_sujets_forum_dark.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des sujet du forum</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="content">
        <div id="gauche-cours">
            <ul id="liste-cours">
                <?php include('../PHP/forum_liste_cours.php'); ?>
            </ul>
        </div>
        <div id="droite-sujets">
            <?php include('../PHP/forum_liste_sujets.php'); ?>
        </div>
    </div>
</body>
</html>

<script src="../JS/liste_sujets_forum.js"></script>
