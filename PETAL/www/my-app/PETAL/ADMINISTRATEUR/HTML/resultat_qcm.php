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
    <title>Resultat du QCM</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.php");?>
    <div id="corps">
    	<div id="titre">
    		<h1>Resultat QCM 1</h1>
    	</div>
        <div id="conteneurRetour"><a href="liste_qcm.php" id="retour">retour</a></div>
        <div id="tableaux">
    	   <div id="result">
                <table id="resultats">
                    <tr class="entete">
                        <td>Etudiant</td>
                        <td>Note</td>
                    </tr>
                    <?php AfficheListeResultatQCM(); ?>
                </table>   
           </div>
            <div id="moy">
                <table id="moyenne">
                    <tr class="entete">
                        <td id="moyenneTd1">Moyenne</td>
                    </tr>
                    <tr>
                        <td id="moyenneTd2">
                            <?php AfficheMoyenneQCM(); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
