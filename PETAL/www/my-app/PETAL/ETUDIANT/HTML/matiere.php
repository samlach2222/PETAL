<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/matiere_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/matiere_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des matieres</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.php");?>
    <?php include("../PHP/script_matiere.php"); ?>
</body>
</html>
