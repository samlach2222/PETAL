<?php
    //Variables
    $numEtudiant = $_SESSION['num'];
    $numMatiere = $_GET['matiere'];
    $nomMatiere = "";

    //connexion à la BDD
    $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";

    try {
        $pdo = new PDO($dsn, "root", "root");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //Requête
    $sql = "SELECT nomMatiere FROM etumatiere WHERE num=".strval($numEtudiant);
    $donnees = $pdo->query($sql);

    $nb=0;
    while ($tmp = $donnees->fetch()){
        if($nb == $numMatiere)
        {
            $nomMatiere = $tmp[0];
        }
        $nb++;
    }

    echo "
        <div id=\"content\">
        <div id=\"titre\">
            <h1>".$nomMatiere."</h1>
            <a class=\"retour\" href=\"accueil_etudiant.php\"><- retour</a>
        </div>
        <h2>CM</h2>
            <div class=\"liste\">
                <a href=\"https://google.com\"><div class=\"cours\">CM1</div></a>
                <a href=\"https://google.com\"><div class=\"cours\">CM2</div></a>
            </div>
        <h2>TD</h2>
            <div class=\"liste\">
                <a href=\"https://google.com\"><a href=\"https://google.com\"><div class=\"cours\">TD1</div></a>
                <a href=\"https://google.com\"><div class=\"cours\">TD2</div></a>
                <a href=\"https://google.com\"><div class=\"cours\">TD3</div></a>
            </div>
        <h2>TP</h2>
            <div class=\"liste\">
                <a href=\"https://google.com\"><div class=\"cours\">TP1</div></a>
                <a href=\"https://youtube.com\"><div class=\"cours\">TP2</div></a>
                <a href=\"https://google.com\"><div class=\"cours\">TP3</div></a>
                <a href=\"https://google.com\"><div class=\"cours\">TP4</div></a>
                <a href=\"https://google.com\"><div class=\"cours\">TP5</div></a>
            </div>
        <h2>QCM</h2>
            <a href=\"https://google.com\" target=\"_blank\" class=\"lien\">QCM 1</a>
            <a href=\"https://google.com\" target=\"_blank\" class=\"lien\">QCM 2</a>
        <h2>Evaluation</h2>
            <a href=\"https://google.com\" target=\"_blank\" class=\"lien\">Evalutation n°1</a>
    ";
?>