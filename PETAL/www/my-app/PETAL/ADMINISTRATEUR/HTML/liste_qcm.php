<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    if($_COOKIE['theme'] == 0) { //light
        echo '<link rel="stylesheet" href="../CSS/liste_qcm_light.css">';
    }
    else { //dark
        echo '<link rel="stylesheet" href="../CSS/liste_qcm_dark.css">';
    }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des QCM</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.php");
    include("../PHP/script_liste_qcm.php");
    ?>
    <div id="corps">
    	<div id="title">
            <h1>Liste des QCM</h1>
        </div>
    	<div id="toolbar">
            <div id="conteneurBoutonRetour">
                <a href="accueil_admin.php" id="boutonRetour">retour</a>
            </div>
            <a href="edition_qcm.php">
                <img id="plus" src="../../Ressources/Pictures/Plus_Dark.png" class="icon">
            </a>
            <a href="javascript:EditerQCM()">
                <img id="crayon" src="../../Ressources/Pictures/Crayon_Dark.png" class="icon">
            </a>
            <a href="javascript:SupprimerQCM()">
                <img id="corbeille" src="../../Ressources/Pictures/Corbeille_Dark.png" class="icon">
            </a>
        </div>
    	<ul id="liste">
            <?php AfficheListeQCM(); ?>
    	</ul>
    </div>
    <input type="hidden" id="session" value="<?php echo $_SESSION['num'];?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../ADMINISTRATEUR/JS/liste_qcm.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../../ALL/JS/notify.js"></script>
</body>
</html>
