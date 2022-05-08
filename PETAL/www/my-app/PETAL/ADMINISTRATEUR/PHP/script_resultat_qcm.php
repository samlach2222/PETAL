<?php
    function AfficheNomQCM() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        
        $prepared = $pdo->prepare("SELECT nomQCM FROM qcm WHERE idQCM = :idQCM;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('idQCM' => $_GET['id']));
        $rows = $prepared->fetchAll();
        
        echo $rows[0][0];
    }

    function AfficheListeResultatQCM() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $idQCM=$_GET['id'];  // Requete de récupération 
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
        $idQCM=$_GET['id'];  // Requete de récupération 
        $queryM = "SELECT moyenne, idQCM FROM moyenneqcm WHERE idQCM = " . $idQCM;
        foreach ($pdo->query($queryM) as $row) {
            echo "<span>".str_replace('.',',',$row[0])."/20 </span>";
        }
    }
?>
