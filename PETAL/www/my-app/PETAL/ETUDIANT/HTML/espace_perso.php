<?php
    session_start();
    try
    {
        $conn = new PDO('mysql:host=localhost;dbname=petal_db','root', 'root');    
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    $_SESSION['id'];

    $req = $donn->('SELECT id, numEtudiant FROM etudiant')

?>

<!DOCTYPE html>
<!-- Espace perso --> 
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="../CSS/espace_perso_dark.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title> Espace Personnel </title>
</head>
<body>    
    <?php include("../../ALL/HTML/bandeau.html");?>
    
    <div id="esp_perso">
        <a id="retour" href="../../ETUDIANT/HTML/accueil_etudiant.php"> Retour </a>
        <h1> Mon espace </h1>
        <br />

        <div>
            <ul> <li>Informations personnelles :</li> </ul>
            <table id="info">
                <tr>
                    <td>
                        <p> NOM Prenom :</p>
                        <output id="name"> </output>
                        <?php
                            echo "<input
                        ?>
                    </td>
                    <td>
                        <p> Numero Etudiant :</p>
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

        <div id="tabNote">
            <ul> <li>Detail des Cours :</li></ul>
            <table id="tableau">
                <tr id="en-tete">
                    <td>
                        <p> Cours </p>
                    </td>
                    <td>
                        <p>  Note </p>
                    </td>
                    <td>
                        <p>  Mention </p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <output id="nameCours"> </output>
                    </td>
                    <td>
                        <output id="note"> </output>
                    </td>
                    <td>
                        <output id="mention"> </output>
                    </td>
                </tr>
            </table>

        </div>

    </div>

</body>
</html>