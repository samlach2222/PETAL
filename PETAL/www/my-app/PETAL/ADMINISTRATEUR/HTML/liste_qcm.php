<!DOCTYPE html>
<html lang="fr">
<head>
    <!--<link rel="stylesheet" href="../../ALL/CSS/bandeau.css">
    <link rel="stylesheet" href="../CSS/liste_qcm_dark.css">-->
    <link rel="stylesheet" href="../../ALL/CSS/bandeau_light.css">
     <link rel="stylesheet" href="../CSS/liste_qcm_light.css"> 
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des QCM</title>
</head>
<body>
	<!-- faire les themes -->
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="corps">
    	<!-- voir le bandeau -->
    	<h1 class="bandeau2" id="titre">Liste des QCM</h1>
    	<div class="bandeau2" id="bandeau3">
    		<a href="acceuil_admin.php" id="retour"><-retour</a>
    		<div><!--
    			<img src="../../Ressources/Pictures/Plus_Dark.png" class="imageIcon">
    			<img src="../../Ressources/Pictures/Crayon_Dark.png" class="imageIcon">
    			<img src="../../Ressources/Pictures/Corbeille_Dark.png" class="imageIcon">
                -->
                    <img src="../../Ressources/Pictures/Plus_Picture_Light.png" class="imageIcon">
                    <img src="../../Ressources/Pictures/Crayon_Light.png" class="imageIcon">
                    <img src="../../Ressources/Pictures/Corbeille_Light.png" class="imageIcon">
                
    		</div>
    	</div>
    	<ul>
    		<!-- faire les li -->
    		<li>
    			<input type="checkbox" name="QCM1">
    			<a href="edition_qcm.php">
                    <span>qcm1</span>
                    <span> publié </span>         
                </a>
                <!--
    			<img src="../../Ressources/Pictures/Eye_Dark.png" id="eyeIcon">
                 -->
                    <a href="resultat_qcm.php"><img src="../../Ressources/Pictures/Eye_Light.png" id="eyeIcon"></a>
               
    		</li>
            <li>
                <input type="checkbox" name="QCM1">
                <span>qcm2</span>
                <span> non publié </span>
                <!--
                <img src="../../Ressources/Pictures/Eye_Dark.png" id="eyeIcon">
                 -->
                    <img src="../../Ressources/Pictures/Eye_Light.png" id="eyeIcon">
               
            </li>
    	</ul>
    </div>
</body>
</html>
