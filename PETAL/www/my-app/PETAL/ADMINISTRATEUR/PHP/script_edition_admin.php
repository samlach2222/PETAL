<?php
    // Quand on appuie sur le bouton valider
    if(isset($_POST['valider'])) {
        EnvoiAjoutAdminitrateur();
    }

    if(isset($_POST)) {
        // Reception de l'ID de modification
        if (isset($_POST['data'])) {
            $idUtilisateur = json_decode($_POST['data']);

            // Initialisation connexion BDD
            $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
            try {
                $pdo = new PDO($dsn, "root", "root");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }

            // Requete de récupération de tout les utilisateurs
            $query = "SELECT photoProfil, prenom, nom, motDePasse, adresseMail, numeroTelephone, num FROM utilisateur WHERE num = " . $idUtilisateur;

            $dom = new DOMDocument;
            $dom->loadHTML("../HTML/edition_admin.php");
            foreach ($pdo->query($query) as $row) { // modification des champs
                $img = imagecreatefromstring(base64_decode($row[0]));
                $dom->getElementById("b64Image")->value = $row[0];
                $dom->getElementById("b64Image")->background_image = $img;
                $dom->getElementById("prenomAdmin")->value = $row[1];
                $dom->getElementById("nomAdmin")->value = $row[2];
                $dom->getElementById("passAdmin")->value = $row[3];
                $dom->getElementById("mailAdmin")->value = $row[4];
                $dom->getElementById("telAdmin")->value = $row[5];
                $dom->getElementById("numAdmin")->value = $row[6];
            }
        }
    }



    // Si l'on reviens sur la même page avec une erreur d'insertion
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "error") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Identifiants incorrects");</script>';
        }
    }

    function EnvoiAjoutAdminitrateur()
    {
        // Récupération des données
        $photoProfil = $_POST["b64Image"];
        $prenom = $_POST['prenomAdmin'];
        $nom = $_POST['nomAdmin'];
        $adresseMail = $_POST['mailAdmin'];
        $numeroTelephone = $_POST['telAdmin'];
        $motDePasse = $_POST['passAdmin'];
        $numAdmin = $_POST['numAdmin'];

        // vérification des données
        if($prenom == null || $nom == null || $adresseMail == null || $motDePasse == null || $numAdmin == null){
            header("Location: ../HTML/edition_admin.php?ajout=error");
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
            $statement = $pdo->prepare('INSERT INTO utilisateur (num, admin, photoProfil, nom, prenom, adresseMail, numeroTelephone, motDePasse) VALUES (:numAdmin, :admin, :photoProfil, :nom, :prenom, :adresseMail, :numeroTelephone, :motDePasse)');
            $statement->execute([
                'numAdmin' => $numAdmin,
                'admin' => 1,
                'photoProfil' => $photoProfil,
                'prenom' => $prenom,
                'nom' => $nom,
                'adresseMail' => $adresseMail,
                'numeroTelephone' => $numeroTelephone,
                'motDePasse' => $motDePasse
            ]);

            // Redirection en fin de requête
            header("Location: ../HTML/gestion_utilisateurs.php?ajout=success");
        }
    }
?>
