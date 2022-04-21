<?php
    // Quand on appuie sur le bouton valider
    if(isset($_POST['valider']))
    {
        EnvoiAjoutAdminitrateur();
    }

    // Si l'on reviens sur la même page avec une erreur d'insertion
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "error") {
            echo '<script>alert("Identifiants incorrects")</script>';
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
        if($nom == null || $adresseMail == null || $motDePasse == null){
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
            $statement = $pdo->prepare('INSERT INTO utilisateur (photoProfil, nom, prenom, adresseMail, numeroTelephone, motDePasse) VALUES (:photoProfil, :nom, :prenom, :adresseMail, :numeroTelephone, :motDePasse)');
            $statement->execute([
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
