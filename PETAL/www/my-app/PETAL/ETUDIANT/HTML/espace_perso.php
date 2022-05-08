<!DOCTYPE html>
<!-- Espace perso --> 
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/espace_perso_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/espace_perso_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title> Espace Personnel </title>
</head>
<body>    
    <?php include("../../ALL/HTML/bandeau.php");?>
    <?php include("../PHP/script_espace_perso.php");?>
    
    <div id="esp_perso">
        <a id="retour" href="../../ETUDIANT/HTML/accueil_etudiant.php"> Retour </a>
        <h1> Mon espace </h1>
        <br />

        <div>
            <ul> <li>Informations personnelles :</li> </ul>
            <table id="info">
                <tr>
                    <td>
                        <p> Prénom NOM :</p>
                        <output id="name"> <?php echo $_SESSION['nom'] ?> </output>
                    </td>
                    <td>
                        <p> Numéro de téléphone :</p>
                        <output id="numTel"> <?php echo $_SESSION['numTel'] ?> </output>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p> Numéro d'utilisateur :</p>
                        <output id="idAdmin"> <?php echo $_SESSION['num'] ?> </output>
                    </td>
                    <td>
                        <p> Mail :</p>
                        <output id="mailEtu"> <?php echo $_SESSION['adresseMail'] ?> </output>
                    </td>
                </tr>
            </table>

        </div>
        <br/>

        <?php include("../PHP/script_tableau_perso.php");?>

    </div>

</body>
</html>