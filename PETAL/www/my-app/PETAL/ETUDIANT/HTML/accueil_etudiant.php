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
                <!--<tr>
                    <td class="espace">

                        <a href="matiere.php">
                            <table class="matiere">
                                <tr>
                                    <th>
                                        <span class="nomCours">BDD</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="image">
                                        Image 1
                                    </td>
                                </tr>    
                            </table>
                        </a>

                    </td>
                    <td class="espace">

                        <a href="matiere.php">
                            <table class="matiere">
                                <tr>
                                    <th>
                                        <span class="nomCours">CDAA</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="image">
                                        Image 2
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </td>
                    <td class="espace">

                        <a href="matiere.php">
                            <table class="matiere">
                                <tr>
                                    <th>
                                        <span class="nomCours">Modélisation</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="image">
                                        Image 3
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </td>
                </tr>

                <tr>
                    <td class="espace">

                        <a href="matiere.php">
                            <table class="matiere">
                                <tr>
                                    <th>
                                        <span class="nomCours">Synthèse d'Images</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="image">
                                        Image 4
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </td>
                    <td class="espace">

                        <a href="matiere.php">
                            <table class="matiere">
                                <tr>
                                    <th>
                                        <span class="nomCours">Systèmes & Réseaux</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="image">
                                        Image 5
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </td>
                    <td class="espace">

                        <a href="matiere.php">
                            <table class="matiere">
                                <tr>
                                    <th>
                                        <span class="nomCours">Maths</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="image">
                                        Image 6
                                    </td>
                                </tr>
                            </table>
                        </a>

                    </td>
                </tr>-->
                <?php
                include("../php/script_accueil_etudiant.php");
                ?>
            </table>
        </div>
    </body>
</html>