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
            $photoProfilB64 = $row[0];
            $img = imagecreatefromstring(base64_decode($row[0]));
            $prenomEtu = $row[1];
            $nomEtu = $row[2];
            $passEtu = $row[3];
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
            $statement->execute([
                'numEtudiant' => $numEtu,
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
