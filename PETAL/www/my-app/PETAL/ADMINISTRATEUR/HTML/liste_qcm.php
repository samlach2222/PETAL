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
    	<div id="title">
            <h1>Liste des QCM</h1>
        </div>
    	<div id="toolbar">
    		<div id="conteneurBoutonRetour"><a href="accueil_admin.php" id="retour">retour</a></div>
                <!--
    			<img src="../../Ressources/Pictures/Plus_Dark.png" class="imageIcon">
    			<img src="../../Ressources/Pictures/Crayon_Dark.png" class="imageIcon">
    			<img src="../../Ressources/Pictures/Corbeille_Dark.png" class="imageIcon">
                -->
                <a href="edition_qcm.php"><img src="../../Ressources/Pictures/Plus_Picture_Light.png" class="imageIcon"></a>
                <a href="edition_qcm.php"><img src="../../Ressources/Pictures/Crayon_Light.png" class="imageIcon"></a>
                <img src="../../Ressources/Pictures/Corbeille_Light.png" class="imageIcon">
    	</div>
    	<ul>
    		<!-- faire les li -->
    		<li>
    			<label>
                    <input type="checkbox" name="QCM1">
                    <span>
                        qcm1 publié       
                        <!--
                        <img src="../../Ressources/Pictures/Eye_Dark.png" id="eyeIcon">
                        -->
                        <a href="resultat_qcm.php"><img src="../../Ressources/Pictures/Eye_Light.png" id="eyeIcon"></a>
                    </span>         
                </label>
    		</li>
            <li>
                <label>
                    <input type="checkbox" name="QCM2">
                    <span>
                        qcm2 non publié      
                        <!--
                        <img src="../../Ressources/Pictures/Eye_Dark.png" id="eyeIcon">
                        -->
                        <a href="resultat_qcm.php"><img src="../../Ressources/Pictures/Eye_Light.png" id="eyeIcon"></a>
                    </span>
                </label>
            </li>
            <li>
                <label>
                     <input type="checkbox" name="QCM3">
                    <span>
                        qcm3 non publié         
                        <!--
                        <img src="../../Ressources/Pictures/Eye_Dark.png" id="eyeIcon">
                        -->
                        <a href="resultat_qcm.php"><img src="../../Ressources/Pictures/Eye_Light.png" id="eyeIcon"></a>
                    </span>
                </label>
            </li>
    	</ul>
    </div>
</body>
</html>
