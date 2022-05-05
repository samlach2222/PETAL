<?php
    // Si l'on reviens sur la page de gestion après avoir ajouté un qcm
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "success") {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertSuccess("QCM ajouté avec succès");</script>';
        }
        else if ($_GET['ajout'] == "error") {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Erreur : Création non effectuée");</script>';
        }
    }
    else if(!empty($_GET['modification'])) {
        if($_GET['modification'] == "error") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Erreur : Modification non effectuée");</script>';
        }
        else if($_GET['modification'] == "success") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertSuccess("Modification effectée avec succès");</script>';
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
                $publication="[Publié]";
                echo "
                <li id=\"qcm".$row[2]."\">
                    <label>
                        <input type=\"hidden\" name=\"idQCM\" value=\"" . $row[2] . "\" id=\"idQCM\"/>
                        <input type=\"checkbox\" class=\"CB\" name=\"qcm\" value=\"value\"/>
                        <span>" .ucfirst(strtolower($row[0]))." ".$publication. "</span>
                        <a href=\"javascript:VoirResultatQCM(" . $row[2] . ")\">
                            <img src=\"../../Ressources/Pictures/Eye_Light.png\" id=\"eyeIcon\">
                        </a>
                    </label>
                </li>";
            }
            else{
                $publication="[Non publié]";
                echo "
                <li id=\"qcm".$row[2]."\">
                    <label>
                        <input type=\"hidden\" name=\"idQCM\" value=\"" . $row[2] . "\" id=\"idQCM\"/>
                        <input type=\"checkbox\" class=\"CB\" name=\"qcm\" value=\"value\"/>
                        <span>" .ucfirst(strtolower($row[0]))." ".$publication. "</span>
                    </label>
                </li>";
            }
        }
    }
?>