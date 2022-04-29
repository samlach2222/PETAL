<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/gestion_utilisateurs_dark.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
</head>

<body>
<?php
    include("../../ALL/HTML/bandeau.html");
    include("../PHP/script_gestion_utilisateurs.php");
?>
    <div id="content">
        <div id="title">
            <h1>Gestion des utilisateurs</h1>
        </div>
        <div id="toolbar">
            <div id="conteneurBoutonRetour">
                <a href="accueil_admin.php" id="boutonRetour">retour</a>
            </div>
            <a href="edition_admin.php">
                <img id="plusAdmin" src="../../Ressources/Pictures/Plus_Administrateur_Dark.png" class="icon">
            </a>
            <a href="edition_etudiant.php">
                <img id="plusEtudiant" src="../../Ressources/Pictures/Plus_Utilisateur_Dark.png" class="icon">
            </a>
            <a href="javascript:EditerUtilisateur()">
                <img id="crayon" src="../../Ressources/Pictures/Crayon_Dark.png" class="icon">
            </a>
            <a href="javascript:SupprimerUtilisateurs()">
                <img id="corbeille" src="../../Ressources/Pictures/Corbeille_Dark.png" class="icon">
            </a>
        </div>
        <div id="liste">
            <table>
                <?php AfficheListeUtilisateurs(); ?>
            </table>
        </div>
    </div>
    <input type="hidden" id="session" value="<?php echo $_SESSION['num'];?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../ADMINISTRATEUR/JS/gestion_utilisateurs.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../../ALL/JS/notify.js"></script>
</body>
</html>


