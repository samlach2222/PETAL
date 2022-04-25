<?php
    // Si l'on reviens sur la page de gestion après avoir ajouté un utilisateur
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "success") {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertSuccess("Utilisateur ajouté avec succès");</script>';
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

            $query = "DELETE FROM utilisateur WHERE num IN ( ";
            foreach($idList as $id){
                if($id == end($idList)) {
                    $query .= $id.")";
                }
                else {
                    $query .= $id.", ";
                }
            }

            print_r($query);

                // Requete d'insertion
            $pdo->exec($query);
        }
    }

    // Permet d'afficher la liste des utilisateurs dans la page HTML
    function AfficheListeUtilisateurs() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Requete de récupération de tout les utilisateurs
        $query = "SELECT nom, prenom, num, admin from utilisateur";

        foreach ($pdo->query($query) as $row) {
            echo "<tr>
                    <td>
                        <label>
                            <input type=\"hidden\" name=\"identifiant\" value=" . $row[2] . " id=\"identifiant\"/>
                            <input type=\"hidden\" name=\"administrateur\" value=" . $row[3] . " id=\"administrateur\"/>
                            <input type=\"checkbox\" class=\"CB\" name=\"key\" value=\"value\"/>
                            <span>" . strtoupper($row[0]) . " " . ucfirst(strtolower($row[1])) . "</span>
                        </label>
                    </td>
                  </tr>";
        }
    }
?>