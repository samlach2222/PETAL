<?php
    // Quand on appuie sur le bouton valider
    if (isset($_POST['valider'])) {
        EnvoiAjoutMatiere();
    }

    // Si l'on reviens sur la même page avec une erreur d'insertion
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "error") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Veuillez saisir un nom pour la matière");</script>';
        }
        else if($_GET['ajout'] == "alreadyExists") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Le nom de cette matière existe déjà");</script>';
        }
    }


    function EnvoiAjoutMatiere()
    {
        $imageMatiere = $_POST["b64Image"];
        $nomMatiere = $_POST['titreMatiere'];

        if ($nomMatiere == null) {
            header("Location: ../HTML/edition_matiere.php?ajout=error");
        }
        else {
            // Initialisation connexion BDD
            $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
            try {
                $pdo = new PDO($dsn, "root", "root");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            // Requete d'insertion
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $statement = $pdo->prepare('INSERT INTO Matiere (nomMatiere, image, num) VALUES (:nomMatiere, :image, :num)');
            $executed = $statement->execute([
                'nomMatiere' => $nomMatiere,
                'image' => base64_decode($imageMatiere),
                'num' => $_SESSION['num'],
            ]);

            if ($executed) { // si la requête n'a pas pu être passée
                // Redirection en fin de requête
                header("Location: ../HTML/gestion_matiere.php?ajout=success");
            } else {
                // Redirection en fin de requête
                header("Location: ../HTML/edition_matiere.php?ajout=alreadyExists");
            }
        }
    }
?>