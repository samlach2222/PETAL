<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    if($_COOKIE['theme'] == 0) { //light
        echo '<link rel="stylesheet" href="../CSS/gestion_matiere_light.css">';
    }
    else { //dark
        echo '<link rel="stylesheet" href="../CSS/gestion_matiere_dark.css">';
    }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Gestion des matières</title>
</head>

<body>
<?php
    include("../../ALL/HTML/bandeau.php");
    include("../PHP/script_gestion_matiere.php");
?>
    <div id="content">
        <div id="title">
            <h1>Gestion des matières</h1>
        </div>

        <div id="toolbar">
            <div id="conteneurBoutonRetour">
                <a href="accueil_admin.php" id="boutonRetour">retour</a>
            </div>
            <a href="edition_matiere.php">
                <span id="plus" >+</span>
            </a>
            <a href="">
                <img id="corbeille" src="../../Ressources/Pictures/Corbeille_Dark.png" class="icon">
            </a>
        </div>

        <div>
            <table id="allMatiere">
                <?php AfficheListeMatieres(); ?>
            </table>
        </div>
    </div>
    <script src="../../ADMINISTRATEUR/JS/gestion_matiere.js"></script>
</body>
</html>
