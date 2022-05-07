<?php
    // Si l'on reviens sur la page de gestion après avoir ajouté un cours
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "success") {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertSuccess("Cours ajouté avec succès");</script>';
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
            echo '<script>AlertSuccess("Cours modifié avec succès");</script>';
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

            $query = "DELETE FROM cours WHERE idCours IN ( ";
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
    function AfficheTitre(){
        $nomMatiere=$_GET['matiere'];
        //var_dump($nomMatiere);exit;
        echo "<h1>Cours de ".$nomMatiere."</h1>";
    }
    function AfficheListeCours() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $nomMatiere=$_GET['matiere'];
        // Requete de récupération de tout les cours
        $query = "SELECT nomCours, idCours, nomMatiere from cours";

        foreach ($pdo->query($query) as $row) {
            if ($row[2]==$nomMatiere) {
                echo "
                <li id=\"cours".$row[1]."\">
                    <label>
                        <input type=\"hidden\" name=\"idCours\" value=\"" . $row[1] . "\" id=\"idCours\"/>
                        <input type=\"checkbox\" class=\"CB\" name=\"cours\" value=\"value\"/>
                        <span>" .ucfirst(strtolower($row[0])). "</span>
                    </label>
                </li>";
            }
        }
    }
?>