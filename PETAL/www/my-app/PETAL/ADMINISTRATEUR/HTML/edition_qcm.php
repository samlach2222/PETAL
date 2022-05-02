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
    				<td>
    					<label>Nom</label>
    					<input type="text" id="nom" name="nom">
    				</td>
    				<td>
    					<label>Matière</label>
    					<input type="text" name="matiere" id="matiere">
    				</td>
    				<td>
    					<label>Date/heure de fin</label>
    					<input type="date" name="dateHeureFin" id="dateHeureFin">
    				</td>
    			</tr>
    		</table>
    		<hr>
    		<div id="questions">
                <div class="question">
                    <label>Question </label>
                    <output id="out1">1</output>
                    <label> : </label>
                    <input type="text" name="question" id="intitule1">
                    <button onclick="AjoutImageQCM()" class="BtAjoutImage" id="bt1">Ajout image</button>
                    <input type="hidden" id="b64Image1" name="b64Image" value="">
                    <br>
                    <div id="reponses1">
                        <input type="radio" name="reponse" id="reponseRB1a">
                            <input type="text" name="reponse" id="reponse1a"><br>
                        <input type="radio" name="reponse" id="reponseRB1b">
                            <input type="text" name="reponse" id="reponse1b"><br>
                        <input type="radio" name="reponse" id="reponseRB1c">
                            <input type="text" name="reponse" id="reponse1c"><br>         
                    </div>
                </div>      
            </div>
    		<div id="boutonBas">
                <button onclick="ajoutQuestion()" class="SecondButton">+</button>
                <input type="submit" class="SecondButton" name="valider" value="Valider" id="valider">
                <input type="submit" class="SecondButton" name="publier" value="Publier" id="publier">    
            </div>
    	</form>
    </div>
    <script src="../JS/edition_qcm.js"></script>
</body>
</html>
