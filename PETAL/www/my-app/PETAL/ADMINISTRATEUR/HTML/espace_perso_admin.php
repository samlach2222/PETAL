<!DOCTYPE html>
<!-- Espace perso --> 
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="../CSS/espace_perso_admin_light.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title> Espace Personnel </title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    
    <div id="esp_perso">
        <a href="../../ADMINISTRATEUR/HTML/accueil_admin.php" id="retour"> Retour </a>
        <h1> Mon espace </h1>
        <br />

        <div>
            <ul> <li>Informations personnelles :</li> </ul>
            <table id="info">
                <tr>
                    <td>
                        <p> NOM Prenom :</p>
                        <output id="name"> </output>
                    </td>
                    <td>
                        <p> Numero Administrateur :</p>
                        <output id="numEtu"> </output>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p> Identifiant :</p>
                        <output id="idEtu"> </output>
                    </td>
                    <td>
                        <p> Mail :</p>
                        <output id="mailEtu"> </output>
                    </td>
                </tr>
            </table>

        </div>
        </br>
    </div>

</body>
</html>