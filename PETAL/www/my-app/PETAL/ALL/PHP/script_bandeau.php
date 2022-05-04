<?php

    function ResumeSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    function Redirect() {
        if (empty($_SESSION['num'])) {
            header("location: ../../ALL/HTML/connexion.php");
            exit;
        }
    }

    function ShowForumButton() {
        if (!$_SESSION['admin']) {
            echo '<div id="boutonForum">
                <a href="../../ETUDIANT/HTML/liste_sujets_forum.php">Forum</a>
            </div>';
        }

        // redirection si on est pas dans la bonne section
        $url = $_SERVER['REQUEST_URI'];
        if($_SESSION['admin'] == 1 && strpos($url, "ADMINISTRATEUR") == false) // si on est admin et qu'on est pas dans la partie ADMIN
        {
            header("location: ../../ADMINISTRATEUR/HTML/accueil_admin.php");
        }
        else if($_SESSION['admin'] == 0 && strpos($url, "ETUDIANT") == false) // si on est etudiant et qu'on est pas dans la partie ETUDIANT
        {
            header("location: ../../ETUDIANT/HTML/accueil_etudiant.php");
        }
    }

    function ShowPhotoProfil($idImg, $pixelSize) {
        //Affiche logo petal avec un background gradient si il n'a pas de photo de profil
        if (!empty($_SESSION['photoProfil'])) {
            echo '<img id="'.$idImg.'" src="data:image;base64,'.$_SESSION['photoProfil'].'" width="'.$pixelSize.'px" height="'.$pixelSize.'px"/>';
        } else {
            echo '<img id="'.$idImg.'" src="../../Ressources/Icon/logo PETAL profil.svg" width="'.$pixelSize.'px" height="'.$pixelSize.'px" style="background-image: '.$_SESSION['couleurProfil'].'"/>';
        }
    }

    function UrlEspacePerso(){
        if ($_SESSION['admin']) {
            echo '../../ADMINISTRATEUR/HTML/espace_perso_admin.php';
        } else {
            echo '../../ETUDIANT/HTML/espace_perso.php';
        }
    }
?>
