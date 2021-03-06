<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/accueil_admin_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/accueil_admin_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.php");?>
    <div id="PageAccueil">
        <a href="gestion_matiere.php" style="display:block;" class="lien_matiere">
            <table class="gestion">
                <tr>
                    <th>
                        <span class="titre">Gestion des matières</span>
                    </th>
                </tr>
                <tr>
                    <td class="image">
                        <img class="imageSection" src="../../Ressources/Pictures/matiere.png">
                    </td>
                </tr>
            </table>
        </a>
        <a href="liste_qcm.php" style="display:block;" class="lien_matiere">
            <table class="gestion">
                <tr>
                    <th>
                        <span class="titre">Gestion des QCM</span>
                    </th>
                </tr>
                <tr>
                    <td class="image">
                        <img class="imageSection" src="../../Ressources/Pictures/qcm.png">
                    </td>
                </tr>
            </table>
        </a>
        <a href="gestion_utilisateurs.php" style="display:block;" class="lien_matiere">
            <table class="gestion">
                <tr>
                    <th>
                        <span class="titre">Gestion des utilisateurs</span>
                    </th>
                </tr>
                <tr>
                    <td class="image">
                        <img class="imageSection" src="../../Ressources/Pictures/utilisateur.png">
                    </td>
                </tr>
            </table>
        </a>
    </div>
</body>
</html>
