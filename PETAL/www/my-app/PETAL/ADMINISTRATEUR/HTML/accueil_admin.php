<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../ALL/CSS/bandeau.css">
    <link rel="stylesheet" href="../CSS/accueil_admin_light.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="PageAccueil">
        <table id="allTable">
            <tr>
                <td>
                    <a href="gestion_matiere.php">
                        <div id="essaie">
                        <table id="gestionMatiere" class="gestion">
                            <tr>
                                <th>
                                    <span class="titre">Gestion des matières</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                    Image
                                </td>
                            </tr>
                        </table>
                        </div>
                    </a>
                </td>
                <td class="vide"> </td>
                <td>
                    <a href="liste_qcm.php">
                        <table id="gestionQCM" class="gestion">
                            <tr>
                                <th>
                                    <span class="titre">Gestion des QCM</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                    Image
                                </td>
                            </tr>
                        </table>
                    </a>
                </td>
                <td  class="vide"> </td>
                <td>
                    <a href="gestion_utilisateurs.php">
                        <table id="gestionUtilisateurs" class="gestion">
                            <tr>
                                <th>
                                    <span class="titre">Gestion des utilisateurs</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                    Image
                                </td>
                            </tr>
                        </table>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
