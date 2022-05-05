<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/gestion_cours_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/gestion_cours_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Gestion d'un cours</title>
</head>

<body>
    <?php include("../../ALL/HTML/bandeau.php");?>
    <?php include("../PHP/script_cours.php");?>
    <script src="../../ADMINISTRATEUR/JS/gestion_cours.js"></script>
</body>
</html>
