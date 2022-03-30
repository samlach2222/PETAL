<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../ALL/CSS/bandeau.css">
    <link rel="stylesheet" href="../CSS/resultat_qcm_dark.css"><!--
    <link rel="stylesheet" href="../../ALL/CSS/bandeau_light.css">
     <link rel="stylesheet" href="../CSS/resultat_qcm_light.css"> -->
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Resultat du QCM</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="corps">
    	<div id="titre">
    		<a href="liste_qcm.php" id="retour"><-retour</a>
    		<h1>Resultat QCM 1</h1>
    	</div>
    	<table id="resultats">
    		<tr class="entete">
    			<td>Etudiant</td>
    			<td>Note</td>
    		</tr>

    		<tr class="note">
    			<td>NOM1 Prenom1</td>
    			<td><span>XX</span>/20</td>
    		</tr>

    		<tr class="note">
    			<td>NOM2 Prenom2</td>
    			<td><span>XX</span>/20</td>
    		</tr>

    		<tr class="note">
    			<td>NOM3 Prenom3</td>
    			<td><span>XX</span>/20</td>
    		</tr>

    		<tr class="note">
    			<td>NOM4 Prenom4</td>
    			<td><span>XX</span>/20</td>
    		</tr>
    	</table>
    	<table id="moyenne">
    		<tr class="entete">
    			<td id="moyenneTd1">
    				Moyenne
    			</td>
    		</tr>
    		<tr>
    			<td id="moyenneTd2">
    				<span>XX</span>/20
    			</td>
    		</tr>
    	</table>
    </div>
</body>
</html>
