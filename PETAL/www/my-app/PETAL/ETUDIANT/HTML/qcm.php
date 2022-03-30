<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/qcm_light.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des QCM</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>

    <!-- enlever le point des listes des réponses -->

    <div id="qcm">

        <div>
            <span> Nom QCM </span>
            <output> Note </output>
            <br/>
            <a id="retour" href="../../ETUDIANT/HTML/accueil_etudiant.php"> Retour </a>

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
                    <li> <input type="radio"/> Raclette </li>
                    <li> <input type="radio"/> Nope </li>
                    <li> <input type="radio"/> D la reponse D </li>
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
