<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/qcm_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/qcm_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des QCM</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>

    <!-- grouper les radio boutons -->

    <div id="qcm">

        <div>
            <a id="retour" href="../../ETUDIANT/HTML/accueil_etudiant.php"> Retour </a>
            <h1> Nom QCM </h1>
            <output> Note </output>
            <br/>

        </div>

        <br/>
        <div id="question">
            <div id="intitule">
                <span> Question 1 : </span>
                <span> ....... </span>
                <img> </img>
            </div>
            <br/>
                <span id="rep"> Reponse 1 :</span>
                <ul>
                    <li> <input type="radio" name="reponse"/> Raclette </li>
                    <li> <input type="radio" name="reponse"/> Nope </li>
                    <li> <input type="radio" name="reponse"/> D la reponse D </li>
                </ul>
            <div >

            </div>
        </div>
        <button id="valider">
            Valider
        </button>
    </div>
    <br/>

</body>
</html>
