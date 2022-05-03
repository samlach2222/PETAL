<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php
            if($_COOKIE['theme'] == 0) { //light
                echo '<link rel="stylesheet" href="../CSS/accueil_etudiant_light.css">';
            }
            else { //dark
                echo '<link rel="stylesheet" href="../CSS/accueil_etudiant_dark.css">';
            }
        ?>
		<link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
        <title>Page d'Accueil</title>
    </head>
    <body>
        <?php include("../../ALL/HTML/bandeau.php");?>

        <div id="content">
            <h1>Recommandation de Cours :</h1>

            <table id="centre">
                <?php
                include("../php/script_accueil_etudiant.php");
                ?>
            </table>
        </div>
    </body>
</html>