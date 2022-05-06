<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/resultat_qcm_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/resultat_qcm_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Ajout d'étudiants</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.php");
    include("../PHP/script_etumatiere.php");?>
    <div id="corps">
    	<div id="titre">
    		<h1>Ajout d'étudiants</h1>
    	</div>
        <div id="conteneurRetour"><a href="liste_qcm.php" id="retour">retour</a></div>
        <div id="tableaux">
    	   <?php AfficheListeEtudiant(); ?>
        </div>
    </div>
</body>
</html>
