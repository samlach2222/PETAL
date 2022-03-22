<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../ALL/CSS/bandeau.css">
    <link rel="stylesheet" href="../CSS/edition_qcm.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'un QCM</title>
</head>
<body class="dark">
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div>
    	<a href="acceuil_admin.php" id="retour"><-retour</a>
    	<form>
    		<table>
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
    		<div>
    			<label>Question </label>
    			<output>1</output>
    			<label> : </label>
    			<input type="text" name="question"><br>
    			<input type="radio" name="reponse1Br">
    				<input type="text" name="reponse1"><br>
    			<input type="radio" name="reponse1Br">
    				<input type="text" name="reponse2"><br>
    			<input type="radio" name="reponse1Br">
    				<input type="text" name="reponse3"><br>
    		</div>
    		<button onclick="ajoutQuestion()">+</button>
    		<button onclick="validation()">Valider</button>
    	</form>
    </div>
</body>
</html>
