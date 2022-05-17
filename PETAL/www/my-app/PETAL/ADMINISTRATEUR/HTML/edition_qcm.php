<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/edition_qcm_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/edition_qcm_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'un QCM</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.php");
        include("../PHP/script_edition_qcm.php");
    ?>
    <div id="corps">
        <div id="titrePage">
            <h1>Edition/Modification d'un QCM</h1>
        </div>
        <div id="conteneurRetour"><a href="liste_qcm.php" id="retour">retour</a></div>
    	<form action="../PHP/script_edition_qcm.php" method="post" id="formQCM">
    		<table id="titre">
    			<tr>
                    <?php 
                    AfficheTitreQCM();
                ?> 
    			</tr>
    		</table>
    		<hr>
    		<div id="questions">
                <?php 
                    AfficheQCM();
                ?>     
            </div>
    		<?php
                AfficheBoutonsBas();
            ?>
            <input type="hidden" name="nbQuestion" id="nbQuestion" <?php
                    updateNbQuestion(); ?>>
            <input type="hidden" name="idQCM" id="idQCM" <?php if(!empty($_GET['id'])) {
                echo "value=\"".$_GET['id']."\"";
            }
            else{
                echo "value=\"-1\"";
            } ?>>
            <input type="hidden" name="nbAjoutQuestionJs" id="nbAjoutQuestionJs" <?php echo "value=\"0\""; ?>>
            <input type="hidden" name="matiereSelectionner" id="matiereSelectionner" <?php updateMatiere(); ?>>
    	</form>
    </div>
    <script src="../JS/edition_qcm.js"></script>
</body>
</html>
