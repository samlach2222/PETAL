<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/ajout_etudiant_matiere_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/ajout_etudiant_matiere_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Ajout d'étudiants à <?php echo $_GET['matiere']; ?></title>
</head>
<body>
    <?php
        include("../PHP/script_ajout_etudiant_matiere.php");
        RedirectGestionMatiere();
        Valider();
        include("../../ALL/HTML/bandeau.php");
    ?>
    <div id="corps">
    	<div id="titre">
    		<h1>Ajout d'étudiants à <?php echo $_GET['matiere']; ?></h1>
    	</div>
        <div>
            <a href="gestion_matiere.php" id="retour">retour</a>
        </div>
        <form id="etudiants" method="POST">
            <div id="liste-etudiants">
                <?php
                    ImageMatiere();
                    AfficheListeEtudiant();
                ?>
                <input type="button" value="Sélectionner tout" id="selectAll" style="border:none; border-top: 4px solid ;" onClick="javascript:SelectionnerTout()">
            </div>
            <?php BoutonValider(); ?>
        </form>
    </div>
    <script src="../JS/ajout_etudiant_matiere.js"></script>
</body>
</html>
