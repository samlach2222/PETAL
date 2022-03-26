<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../ALL/CSS/bandeau_light.css">
    <link rel="stylesheet" href="../CSS/matiere.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des matieres</title>
</head>
<body>
    <div id="content">
        <div class="bandeau">
            <h1 class="titre">Nom Matière</h1>
            <a class="retour" href="accueilEtudiant.php"><- retour</a>
        </div>
        <h1>CM</h1>
            <div class="liste">
                <div class="cours" onclick="window.location='http://google.com';">CM1</div>
                <div class="cours" onclick="window.location='http://google.com';">CM2</div>
            </div>
        <h1>TD</h1>
            <div class="liste">
                <div class="cours" onclick="window.location='http://google.com';">TD1</div>
                <div class="cours" onclick="window.location='http://google.com';">TD2</div>
                <div class="cours" onclick="window.location='http://google.com';">TD3</div>
            </div>
        <h1>TP</h1>
            <div class="liste">
                <div class="cours" onclick="window.location='http://google.com';">TP1</div>
                <div class="cours" onclick="window.location='http://google.com';">TP2</div>
                <div class="cours" onclick="window.location='http://google.com';">TP3</div>
                <div class="cours" onclick="window.location='http://google.com';">TP4</div>
                <div class="cours" onclick="window.location='http://google.com';">TP5</div>
            </div>
        <h1>QCM</h1>
            <a href="https://google.com" target="_blank" class="lien">QCM 1</a>
            <a href="https://google.com" target="_blank" class="lien">QCM 2</a>
        <h1>Evaluation</h1>
            <a href="https://google.com" target="_blank" class="lien">Evalutation n°1</a>
    </div>
    
    <?php include("../../ALL/HTML/bandeau.html");?>
</body>
</html>
