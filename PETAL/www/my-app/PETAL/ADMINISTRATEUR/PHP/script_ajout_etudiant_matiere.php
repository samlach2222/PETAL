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

    function AfficheListeEtudiant() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $idQCM=$_GET['id'];
        $query = "SELECT prenom, nom, num FROM utilisateur WHERE num = " . $row[0];
        foreach ($pdo->query($query) as $row2) {
            echo "<tr class=\"note\"><td>".strtoupper($row2[1])." ".ucfirst(strtolower($row2[0]))."</td>";
        }
    }
    function AfficheListeEtudiant() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $nomMatiere=$_GET['matiere'];
        $liste=array();
        $query = "SELECT num, nomMatiere FROM etumatiere WHERE nomMatiere = " . $nomMatiere;
        foreach ($pdo->query($query) as $row) {
            array_push($liste, $row[0]);
        }
        // Requete de récupération de tout les qcm
        $query = "SELECT prenom, nom, num from utilisateur";
        reset($liste);
        $comp=1;
        foreach ($pdo->query($query) as $row) {
            if ($row[2]==current($liste)) {
                echo "
                <li>
                    <label>
                        <input type=\"hidden\" name=\"numEtu\" value=\"" . $row[2] . "\" id=\"numEtu\"/>
                        <input type=\"checkbox\" class=\"CB\" select=\"selected\" name=\"etu\" value=\"value\"/>
                        <span>" .ucfirst(strtolower($row[0]))." ".strtoupper($row[1]). "</span>
                    </label>
                </li>";
                if ($comp!=count($liste)) {
                    next($liste);
                    $comp=$comp+1;
                }
            }
            else
            {
                echo "
                <li>
                    <label>
                        <input type=\"hidden\" name=\"numEtu\" value=\"" . $row[2] . "\" id=\"numEtu\"/>
                        <input type=\"checkbox\" class=\"CB\"  name=\"etu\" value=\"value\"/>
                        <span>" .ucfirst(strtolower($row[0]))." ".strtoupper($row[1]). "</span>
                    </label>
                </li>";
            }
        }
    }
?>
