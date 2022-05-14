<?php
    // Quand on appuie sur le bouton valider
    if(isset($_POST['valider']))
    {
        EnvoiAjoutEtudiant();
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

    if(!empty($_GET['id'])) {

        // on lance la session si ce n'est pas déjà fait
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["idModif"] = $_GET['id'];

        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Requete de récupération de tout les utilisateurs
        $query = "SELECT photoProfil, prenom, nom, motDePasse, adresseMail, numeroTelephone, num FROM utilisateur WHERE num = " . $_GET['id'];

        foreach ($pdo->query($query) as $row) { // modification des champs
            $photoProfilB64 = base64_encode($row[0]);
            $prenomEtu = $row[1];
            $nomEtu = $row[2];
            $mailEtu = $row[4];
            $telEtu = $row[5];
            $numEtu = $row[6];
        }
    }

    function EnvoiAjoutEtudiant()
    {
        // Récupération des données
        $photoProfil = $_POST["b64Image"];
        $prenom = $_POST['prenomEtu'];
        $nom = $_POST['nomEtu'];
        $adresseMail = $_POST['mailEtu'];
        $numeroTelephone = $_POST['telEtu'];
        $motDePasse = $_POST['passEtu'];

        if(isset($_POST['numEtu'])){ // mode ajout
            $numEtu = $_POST['numEtu'];

            // vérification des données
            if($prenom == null || $nom == null || $adresseMail == null || $motDePasse == null || $numEtu == null){
                header("Location: ../HTML/edition_etudiant.php?ajout=error");
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
                $statement = $pdo->prepare('INSERT INTO utilisateur (num, photoProfil, nom, prenom, adresseMail, numeroTelephone, motDePasse) VALUES (:numEtudiant, :photoProfil, :nom, :prenom, :adresseMail, :numeroTelephone, :motDePasse)');
                $executed = $statement->execute([
                    'numEtudiant' => $numEtu,
                    'photoProfil' => base64_decode($photoProfil),
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'adresseMail' => $adresseMail,
                    'numeroTelephone' => $numeroTelephone,
                    'motDePasse' => password_hash($motDePasse, PASSWORD_DEFAULT)
                ]);
                if($executed){ // si la requête n'a pas pu être passée
                    // Redirection en fin de requête
                    header("Location: ../HTML/gestion_utilisateurs.php?ajout=success&ajoutEtudiant");
                }
                else {
                    // Redirection en fin de requête
                    header("Location: ../HTML/gestion_utilisateurs.php?ajout=error");
                }
            }
        }
        else { // mode modification
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $numEtu = $_SESSION["idModif"];
            // supression de la variable de session
            unset($_SESSION["idModif"]);

            // vérification des données
            if($prenom == null || $nom == null || $adresseMail == null || $motDePasse == null || $numEtu == null){
                header("Location: ../HTML/gestion_utilisateurs.php?modification=error");
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
                $statement = $pdo->prepare('UPDATE utilisateur SET photoProfil = :photoProfil, nom = :nom, prenom = :prenom, adresseMail = :adresseMail, numeroTelephone = :numeroTelephone, motDePasse = :motDePasse WHERE num = :numEtudiant');
                $statement->execute([
                    'numEtudiant' => $numEtu,
                    'photoProfil' => base64_decode($photoProfil),
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'adresseMail' => $adresseMail,
                    'numeroTelephone' => $numeroTelephone,
                    'motDePasse' => password_hash($motDePasse, PASSWORD_DEFAULT)
                ]);

                // Redirection en fin de requête
                header("Location: ../HTML/gestion_utilisateurs.php?modification=success");
            }
        }
    }
?>
