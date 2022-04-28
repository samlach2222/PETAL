<?php
    session_start();
    include('connexion.html');

    try
    {
        $pdo = new PDO('mysql:host=localhost;dbname=petal_db;charset=utf8','root', 'root');    
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    

    if(isset($_POST['nom_user']) && isset($_POST['mdp']))
    {
        //Tentative de connexion
        $prepared = $pdo->prepare("SELECT * FROM utilisateur WHERE (num = :identifiant OR adresseMail = :identifiant) AND motDePasse = :mdp", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('identifiant' => $_POST['nom_user'], 'mdp' => $_POST['mdp']));
        $rows = $prepared->fetchAll();
        if (count($rows) == 1){
            $_SESSION['num'] = $rows[0][0];  //Récupère le num depuis la requête car on ne sait pas si $_POST['nom_user'] est le num ou l'adresse mail
            $_SESSION['admin'] = $rows[0][1];
            $_SESSION['nom'] = $rows[0][4].' '.mb_strtoupper($rows[0][3], 'UTF-8');
            
            if ($_SESSION['admin']){
                header("location: ../../ADMINISTRATEUR/HTML/espace_perso_admin.php");
            } else {
                header("location: ../../ETUDIANT/HTML/espace_perso.php");
            }
            
            exit;
        } else {
            echo '<script type="text/javascript">
                window.onload = () => {
                    alert("Nom d\'utilisateur et/ou mot de passe incorrect");
                };
            </script>';
        }
    }
?>
