<?php
    // Si l'on reviens sur la page de gestion après avoir ajouté un utilisateur
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "success") {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertSuccess("Utilisateur ajouté avec succès");</script>';
        }
    }

    function AfficheListeUtilisateurs() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Requete de récupération de tout les utilisateurs
        $query = "SELECT nom, prenom from utilisateur";

        foreach ($pdo->query($query) as $row) {
            echo "<tr><td><label><input type=\"checkbox\" class=\"CB\" name=\"key\" value=\"value\"/><span>".strtoupper($row[0])." ".ucfirst(strtolower($row[1]))."</span></label></td></td></tr>";
        }
    }
?>