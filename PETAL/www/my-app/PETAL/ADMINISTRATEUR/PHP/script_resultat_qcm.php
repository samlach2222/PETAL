<?php
    // Reception de l'ID de modification
    if (isset($_POST['data'])) {
        $idQCM = json_decode($_POST['data']);

        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        // Requete de récupération 
        $idQCM=$_GET['id'];
    }

    function AfficheListeResultatQCM() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $idQCM=$_GET['id'];
        $queryR = "SELECT num, moyenne, idQCM FROM resultatetudiant WHERE idQCM = " . $idQCM;
        foreach ($pdo->query($queryR) as $row) {
            $query = "SELECT prenom, nom, num FROM utilisateur WHERE num = " . $row[0];
            foreach ($pdo->query($query) as $row2) {
                echo "<tr class=\"note\"><td>".ucfirst(mb_strtolower($row2[0], 'UTF-8')).' '.mb_strtoupper($row2[1], 'UTF-8')."</td>";
            }
            echo "<td><span>".str_replace('.',',',$row[1])."/20</span></td></tr>";
        }
    }
    function AfficheMoyenneQCM() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $idQCM=$_GET['id'];
        $queryM = "SELECT moyenne, idQCM FROM moyenneqcm WHERE idQCM = " . $idQCM;
        foreach ($pdo->query($queryM) as $row) {
            echo "<span>".str_replace('.',',',$row[0])."/20 </span>";
        }
    }
?>
