<?php
    // Si l'on reviens sur la page de gestion après avoir ajouté un qcm
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "success") {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertSuccess("QCM ajouté avec succès");</script>';
        }
    }
    // Permet de supprimer par ID les utilisateurs
    if(isset($_POST)){
        if(isset($_POST['data'])){
            $idList = json_decode($_POST['data']);
            // Initialisation connexion BDD
            $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
            try {
                $pdo = new PDO($dsn, "root", "root");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            $query = "DELETE FROM qcm WHERE idQCM IN ( ";
            foreach($idList as $id){
                if($id == end($idList)) {
                    $query .= $id.")";
                }
                else {
                    $query .= $id.", ";
                }
            }
            // Requete d'insertion
            $pdo->exec($query);
        }
    }
    function AfficheListeQCM() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Requete de récupération de tout les qcm
        $query = "SELECT nomQCM, publie, idQCM from QCM";

        foreach ($pdo->query($query) as $row) {
            if ($row[1]) {
                $publication="Publié";
            }
            else{
                $publication="Non publié";
            }
            echo "
            <li id=\"qcm".$row[2]."\">
                <label>
                    <input type=\"hidden\" name=\"idQCM\" value=\"" . $row[2] . "\" id=\"idQCM\"/>
                    <input type=\"checkbox\" class=\"CB\" name=\"qcm\" value=\"value\"/>
                    <span>" .ucfirst(strtolower($row[0]))." ".$publication. "</span>
                    <a href=\"resultat_qcm.php\">
                        <img src=\"../../Ressources/Pictures/Eye_Dark.png\" id=\"eyeIcon\">
                    </a>
                </label>
            </li>";
        }
    }
?>