<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../ALL/CSS/bandeau.css">
    <link rel="stylesheet" href="../CSS/edition_qcm_dark.css">
    <!--<link rel="stylesheet" href="../../ALL/CSS/bandeau_light.css">
    <link rel="stylesheet" href="../CSS/edition_qcm_light.css">-->
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'un QCM</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="corps">
        <div id="titrePage">
            <h1>Edition/Modification d'un QCM</h1>
        </div>
        <div id="conteneurRetour"><a href="liste_qcm.php" id="retour">retour</a></div>
    	<!--<form action="../PHP/script_edition_qcm.php" method="post" id="formQCM">-->
        <form  method="post" id="formQCM">
    		<table id="titre">
    			<tr>
    				<td>
    					<label>Nom</label>
    					<input type="text" name="nom">
    				</td>
    				<td>
    					<label>Matière</label>
    					<input type="text" name="matiere">
    				</td>
    				<td>
    					<label>Date/heure de fin</label>
    					<input type="date" name="dateHeureFin">
    				</td>
    			</tr>
    		</table>
    		<hr>
    		<div class="question">
    			<label>Question </label>
    			<output>1</output>
    			<label> : </label>
    			<input type="text" name="question">
                <button onclick="AjoutImageQCM()" class="BtAjoutImage">Ajout image</button>
                <input type="hidden" id="b64Image" name="b64Image" value="">
                <br>
    			<div id="reponses">
                    <input type="radio" name="reponse1">
                        <input type="text" name="reponse1"><br>
                    <input type="radio" name="reponse1">
                        <input type="text" name="reponse2"><br>
                    <input type="radio" name="reponse1">
                        <input type="text" name="reponse3"><br>         
                </div>
    		</div>
    		<div id="boutonBas">
                <button onclick="ajoutQuestion()" class="SecondButton">+</button>
                <button onclick="validation()" class="SecondButton">Valider</button>
                <button onclick="publication()" class="SecondButton">Publier</button>      
            </div>
    	</form>
    </div>
    <script src="../../ADMINISTRATEUR/JS/edition_qcm.js"></script>
</body>
</html>
