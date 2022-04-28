<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <link rel="stylesheet" href="../CSS/connexion.css">
    <meta charset="UTF-8">
    <title>Connexion à PETAL</title>
</head>
<body>
    <div id="first">
        <p>Authentification</p>
        <div id="second">
            <form method="POST">
                <label>Nom d'utilisateur</label>
                <span class="hovertext" data-hover="adresse mail ou numéro d'étudiant">?</span>
                <br/>
                <input type="text" name="nom_user"/>
                <br/>
                <br/>
                <label>Mot de passe</label>
                <br/>
                <input type="password" name="mdp"/>
                <br/>
                <br/>
                <div id="second-bottom">
                    <div>
                        <input type="checkbox" name="souvenir"/>
                        <label>Se souvenir de moi</label>
                    </div>
                    <!-- revoir la mise en forme du bouton -->
                    <button type="submit">Connexion</button>
                </div>
            </form>
        </div>
        <!-- envoie un mail à l'utilisateur -->
        <a href="https://www.google.com">Mot de passe oublié</a>
    </div>
    
<?php
    session_start();
    
    if (!empty($_COOKIE['user_souvenir'])) {
        
        //Connexion à la BDD
        try
        {
            $pdo = new PDO('mysql:host=localhost;dbname=petal_db;charset=utf8','root', 'root');    
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        
        //Récupère tous les utilisateurs
        $rows = $pdo->query("SELECT num, admin, photoProfil, nom, prenom, motDePasse FROM Utilisateur");
        
        //Vérifie pour chaque num dans la table Utilisateur si il y a un num qui correspond au num hashé du cookie
        foreach ($rows as $row) {
            if (password_verify($row[5], $_COOKIE['user_souvenir'])) {
                $_SESSION['num'] = $row[0];
                $_SESSION['admin'] = $row[1];
                $_SESSION['photoProfil'] = $row[2];  //convertir depuis base64
                $_SESSION['nom'] = $row[4].' '.mb_strtoupper($row[3], 'UTF-8');
                
                if ($_SESSION['admin']){
                    header("location: ../../ADMINISTRATEUR/HTML/espace_perso_admin.php");
                } else {
                    header("location: ../../ETUDIANT/HTML/espace_perso.php");
                }

                exit;
            }
        }
        
        // Le cookie n'est pas valide, on peut le détruire
        unset($_COOKIE['user_souvenir']);
        setcookie('user_souvenir', '', null, '/my-app/PETAL/ALL'); // empty value and old timestamp
    }

    if(isset($_POST['nom_user']) && isset($_POST['mdp'])) {
        
        //Connexion à la BDD
        try
        {
            $pdo = new PDO('mysql:host=localhost;dbname=petal_db;charset=utf8','root', 'root');    
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        
        //Tentative de connexion
        $prepared = $pdo->prepare("SELECT num, admin, photoProfil, nom, prenom, motDePasse FROM Utilisateur WHERE (num = :identifiant OR adresseMail = :identifiant) AND motDePasse = :mdp", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('identifiant' => $_POST['nom_user'], 'mdp' => $_POST['mdp']));
        $rows = $prepared->fetchAll();
        if (count($rows) == 1) {
            $_SESSION['num'] = $rows[0][0];  //Récupère le num depuis la requête car on ne sait pas si $_POST['nom_user'] est le num ou l'adresse mail
            $_SESSION['admin'] = $rows[0][1];
            $_SESSION['photoProfil'] = $rows[0][2];  //convertir depuis base64
            $_SESSION['nom'] = $rows[0][4].' '.mb_strtoupper($rows[0][3], 'UTF-8');
            
            //Si l'utilisateur a coché "Se souvenir de moi", alors se souvenir de lui
            if (isset($_POST['souvenir'])) {
                setcookie(
                    'user_souvenir',
                    password_hash($rows[0][5], PASSWORD_DEFAULT),  //Ne pas stocké le mot de passe directement
                    time() + (365 * 24 * 60 * 60),  //Expire dans 1 an
                    "/my-app/PETAL/ALL",
                    "",
                    true,
                    true
                );
            }
            
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

</body>
</html>