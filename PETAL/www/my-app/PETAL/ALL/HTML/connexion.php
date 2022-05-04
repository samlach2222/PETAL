<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <link rel="stylesheet" href="../CSS/connexion.css">
    <meta charset="UTF-8">
    <title>Connexion à PETAL</title>
</head>
<body>
    <div id="petalFrame">
    <img id="petalText" src="../../Ressources/Icon/texte%20PETAL.svg"/>
    <div id="first">
        <p>Authentification</p>
        <div id="second">
            <form method="POST">
                <label for="nom_user">Nom d'utilisateur</label>
                <span class="hovertext" data-hover="adresse mail ou numéro d'étudiant">?</span>
                <br/>
                <input type="text" id="nom_user" name="nom_user"/>
                <br/>
                <br/>
                <label for="mdp">Mot de passe</label>
                <br/>
                <input type="password" id="mdp" name="mdp"/>
                <br/>
                <br/>
                <div id="second-bottom">
                    <div>
                        <input type="checkbox" id="souvenir" name="souvenir"/>
                        <label for="souvenir">Se souvenir de moi</label>
                    </div>
                    <!-- revoir la mise en forme du bouton -->
                    <button type="submit">Connexion</button>
                </div>
            </form>
        </div>
        <!-- envoie un mail à l'utilisateur -->
        <a href="https://www.google.com">Mot de passe oublié</a>
    </div>
    </div>

<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //Créer le cookie du theme si il n'existe pas
    if (empty($_COOKIE['theme'])) {
        setcookie(
            'theme',
            0,
            time() + (365 * 24 * 60 * 60),  //Expire dans 1 an
            "/my-app/PETAL"
        );
    }

    if (!empty($_COOKIE['user_souvenir'])) {

        //Connexion à la BDD
        include_once('../PHP/BDD.php');

        //Récupère tous les utilisateurs
        $rows = $pdo->query("SELECT num, admin, photoProfil, nom, prenom, motDePasse FROM Utilisateur");

        //Vérifie pour chaque motDePasse dans la table Utilisateur si il y a un motDePasse qui correspond au motDePasse hashé du cookie
        foreach ($rows as $row) {
            if (password_verify($row[5], $_COOKIE['user_souvenir'])) {
                $_SESSION['num'] = $row[0];
                $_SESSION['admin'] = $row[1];
                $_SESSION['photoProfil'] = base64_encode($row[2]);
                $_SESSION['nom'] = ucfirst(mb_strtolower($row[4], 'UTF-8').' '.mb_strtoupper($row[3], 'UTF-8');

                if ($_SESSION['admin']){
                    header("location: ../../ADMINISTRATEUR/HTML/accueil_admin.php");
                } else {
                    header("location: ../../ETUDIANT/HTML/accueil_etudiant.php");
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
        include_once('../PHP/BDD.php');

        //Tentative de connexion
        $prepared = $pdo->prepare("SELECT num, admin, photoProfil, nom, prenom, motDePasse FROM Utilisateur WHERE (num = :identifiant OR adresseMail = :identifiant) AND motDePasse = :mdp", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('identifiant' => $_POST['nom_user'], 'mdp' => $_POST['mdp']));
        $rows = $prepared->fetchAll();
        if (count($rows) == 1) {
            $_SESSION['num'] = $rows[0][0];  //Récupère le num depuis la requête car on ne sait pas si $_POST['nom_user'] est le num ou l'adresse mail
            $_SESSION['admin'] = $rows[0][1];
            $_SESSION['photoProfil'] = base64_encode($rows[0][2]);
            $_SESSION['nom'] = ucfirst(mb_strtolower($rows[0][4], 'UTF-8').' '.mb_strtoupper($rows[0][3], 'UTF-8');

            //Si l'utilisateur n'a pas de photo de profil, créer un gradient aléatoire à partir de son num
            if (empty($_SESSION['photoProfil'])) {
                $R1 = 50 + $_SESSION['num']*3 % 151;
                $G1 = 50 + $_SESSION['num']*4 % 151;
                $B1 = 50 + $_SESSION['num']*5 % 151;
                $hex1 = '#'.sprintf('%02X', $R1).sprintf('%02X', $G1).sprintf('%02X', $B1);  //dechex n'ajoute pas de 0 de tête

                $R2 = 50 + $_SESSION['num']*8 % 151;
                $G2 = 50 + $_SESSION['num']*7 % 151;
                $B2 = 50 + $_SESSION['num']*6 % 151;
                $hex2 = '#'.sprintf('%02X', $R2).sprintf('%02X', $G2).sprintf('%02X', $B2);

                $_SESSION['couleurProfil'] = 'linear-gradient(to bottom right, '.$hex1.', '.$hex2.')';
            }

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
                header("location: ../../ADMINISTRATEUR/HTML/accueil_admin.php");
            } else {
                header("location: ../../ETUDIANT/HTML/accueil_etudiant.php");
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
