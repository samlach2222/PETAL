<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../ALL/CSS/bandeau.css">
    <link rel="stylesheet" href="../CSS/liste_qcm.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des QCM</title>
</head>
<body class="dark">
	<!-- faire les themes -->
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="corps">
    	<!-- voir le bandeau -->
    	<h1 class="bandeauSecondaireLight">Liste des QCM</h1>
    	<div class="bandeauSecondaireLight" id="bandeau3">
    		<a href="acceuil_admin.php" id="retour"><-retour</a>
    		<div>
    			<img src="../../Ressources/Pictures/Plus_Dark.png" class="imageIcon">
    			<img src="../../Ressources/Pictures/Crayon_Dark.png" class="imageIcon">
    			<img src="../../Ressources/Pictures/Corbeille_Dark.png" class="imageIcon">
    		</div>
    	</div>
    	<ul>
    		<!-- faire les li -->
    		<li>
    			<input type="checkbox" name="QCM1">
    			<span>qcm1</span>
    			<img src="../../Ressources/Pictures/Eye_Dark.png" id="eyeIcon">
    		</li>
    	</ul>
    </div>
</body>
</html>
