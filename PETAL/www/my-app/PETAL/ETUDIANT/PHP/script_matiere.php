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
        ";

    $sql2 = "SELECT nomCours,fichier FROM cours WHERE typeCours='CM' AND nomMatiere='".$nomMatiere."'";
    $donnees2 = $pdo->query($sql2);
    while ($tmp2 = $donnees2->fetch())
    {
        echo "<a href=\"".$tmp2[1]."\" download><div class=\"cours\">".$tmp2[0]."</div></a>";
    }

    echo "
            </div>
        <h2>TD</h2>
            <div class=\"liste\">";

    $sql3 = "SELECT nomCours,fichier FROM cours WHERE typeCours='TD' AND nomMatiere='".$nomMatiere."'";
    $donnees3 = $pdo->query($sql3);
    while ($tmp3 = $donnees3->fetch())
    {
        echo "<a href=\"".$tmp3[1]."\" download><div class=\"cours\">".$tmp3[0]."</div></a>";
    }
                
    echo "     
            </div>
        <h2>TP</h2>
            <div class=\"liste\">";

    $sql4 = "SELECT nomCours,fichier FROM cours WHERE typeCours='TP' AND nomMatiere='".$nomMatiere."'";
    $donnees4 = $pdo->query($sql4);
    while ($tmp4 = $donnees4->fetch())
    {
        echo "<a href=\"".$tmp4[1]."\" download><div class=\"cours\">".$tmp4[0]."</div></a>";
    }
    
    echo "
            </div>
        <h2>QCM</h2>
            <a href=\"https://google.com\" target=\"_blank\" class=\"lien\">QCM 1</a>
            <a href=\"https://google.com\" target=\"_blank\" class=\"lien\">QCM 2</a>
        <h2>Evaluation</h2>
            <a href=\"https://google.com\" target=\"_blank\" class=\"lien\">Evalutation n°1</a>
    ";
?>