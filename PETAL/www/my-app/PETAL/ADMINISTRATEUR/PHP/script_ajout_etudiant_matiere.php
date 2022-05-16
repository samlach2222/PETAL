<?php
    // Initialisation connexion BDD
    include_once('../../ALL/PHP/BDD.php');

    function RedirectGestionMatiere() {
        //Si la matiere n'est pas précisé
        if (empty($_GET['matiere'])) {
            header("location: gestion_matiere.php");
            exit;
        }
        
        //Reprend la session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        global $pdo;
        
        //Essaye de récupèrer l'image de la matière et vérifie que l'admin connecté y a accès
        $prepared = $pdo->prepare("SELECT image FROM matiere WHERE num = :num && nomMatiere = :nomMatiere", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('num' => $_SESSION['num'], 'nomMatiere' => $_GET['matiere']));
        $rows = $prepared->fetchAll();
        
        if (count($rows) == 0) {
            header("location: gestion_matiere.php");
            exit;
        }
        
        global $imageMatiere;
        $imageMatiere = $rows[0][0];
    }

    function ImageMatiere() {
        global $imageMatiere;
        
        //Si l'image n'est pas null
        if ($imageMatiere) {
            echo '<div id="image-matiere" style="background-image: url(\'data:image;base64,'.base64_encode($imageMatiere).'")></div>';
        }
    }

    function AfficheListeEtudiant() {
        
        global $pdo;
        //La quatrième colonne permet de pré-cocher les étudiants ayant actuellement accès à la matière
        $prepared = $pdo->prepare("SELECT utilisateur.num, nom, prenom, IF(!ISNULL(tableEtuMatiere.num), 'checked', null) AS dejaAjoute FROM utilisateur LEFT JOIN (SELECT num FROM etumatiere WHERE nomMatiere = :nomMatiere) AS tableEtuMatiere ON utilisateur.num = tableEtuMatiere.num WHERE admin = 0", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('nomMatiere' => $_GET['matiere']));
        $rows = $prepared->fetchAll();
        
        global $aucunEtudiant;
        $aucunEtudiant = count($rows) == 0;
        
        if (!$aucunEtudiant) {
            $index = 0;
            foreach ($rows as $row) {
                echo '<li>
                    <input type="checkbox" class="CB" name="cb'.$index.'" value="'.$row[0].'" '.$row[3].'/>
                    <span class="nom">'.ucfirst(mb_strtolower($row[2], 'UTF-8')).' '.mb_strtoupper($row[1], 'UTF-8').'</span>
                </li>';
                $index++;
            }
            echo '<input type="hidden" name="nbEtudiants" value="'.$index.'"/>';
        } else {
            echo '<span id="aucun-etudiant">Aucun étudiant existant</span>';
        }
    }

    function BoutonValider() {
        global $aucunEtudiant;
        
        if (!$aucunEtudiant) {
            echo '<button id="valider" type="submit">Valider</button>';
        }
    }

    function Valider() {
        if (!empty($_POST['nbEtudiants'])) {
            global $pdo;
            
            //Supprime d'abord tous les étudiants ayant accès à la matière...
            $prepared = $pdo->prepare("DELETE FROM etumatiere WHERE nomMatiere = :nomMatiere", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $prepared->execute(array('nomMatiere' => $_GET['matiere']));
            
            
            //...Puis insére tous les étudiants selectionnés
            $prepared = $pdo->prepare("INSERT INTO etumatiere VALUES (:num, :nomMatiere)", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            for ($i = 0; $i < $_POST['nbEtudiants']; $i++) {
                if (isset($_POST['cb'.$i])) {
                    $prepared->execute(array('num' => $_POST['cb'.$i], 'nomMatiere' => $_GET['matiere']));
                } 
            }
            
            //Permet de ne pas ré-envoyer le POST si l'utilisateur rafraichie la page
            header("Refresh:0");
        }
    }
?>
