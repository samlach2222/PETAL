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
                    if(!empty($_GET['id'])) {
                        AfficheTitreQCM();
                    }
                    else{
                        echo "<td>
                                <label>Nom</label>
                                <input type=\"text\" required id=\"nom\" name=\"nom\">
                            </td>
                            <td>
                                <label>Matière</label>
                                <input type=\"text\" required name=\"matiere\" id=\"matiere\">
                            </td>
                            <td>
                                <label>Date/heure de fin</label>
                                <input type=\"date\" name=\"dateHeureFin\" id=\"dateHeureFin\">
                        </td>";
                    }
                ?> 
    			</tr>
    		</table>
    		<hr>
    		<div id="questions">
                <?php 
                    AfficheQCM();
                ?>     
            </div>
    		<div id="boutonBas">
                <input type="button" name="add" value="+" id="add" onclick="ajoutQuestion()" class="SecondButton">
                <input type="submit" class="SecondButton" name="valider" value="Valider" id="valider">
                <input type="submit" class="SecondButton" name="publier" value="Publier" id="publier">    
            </div>
            <input type="hidden" name="nbQuestion" id="nbQuestion">
    	</form>
    </div>
    <script src="../JS/edition_qcm.js"></script>
</body>
</html>
