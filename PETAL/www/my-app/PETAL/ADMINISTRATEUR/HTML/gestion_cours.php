<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/gestion_cours_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/gestion_cours_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Gestion d'un cours</title>
</head>

<body>
    <?php include("../../ALL/HTML/bandeau.php");
    include("../PHP/script_gestion_cours.php");?>
    <div id="content">
        <div id="title">
            <?php AfficheTitre(); ?>
        </div>
        <div id="toolbar">
            <div id="conteneurBoutonRetour">
                <a href="gestion_matiere.php" id="boutonRetour">retour</a>
            </div>
            <a href="javascript:AjoutCours()">
                <img id="plus" src="../../Ressources/Pictures/Plus_Dark.png" class="icon">
            </a>
            <a href="javascript:EditerCours()">
                <img id="crayon" src="../../Ressources/Pictures/Crayon_Dark.png" class="icon">
            </a>
            <a href="javascript:SupprimerCours()">
                <img id="corbeille" src="../../Ressources/Pictures/Corbeille_Dark.png" class="icon">
            </a>
        </div>
        <ul id="liste">
            <?php AfficheListeCours(); ?>
        </ul>
        <input type="hidden" name="matiere" id="matiere" <?php if(!empty($_GET['matiere'])) {
                echo "value=\"".$_GET['matiere']."\"";
            }
            else{
                echo "value=\"-1\"";
            } ?>>
    </div>
    <input type="hidden" id="session" name="session" value="<?php echo $_SESSION['num'];?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../../ALL/JS/notify.js"></script>
    <script src="../../ADMINISTRATEUR/JS/gestion_cours.js"></script>
</body>
</html>
