<?php
    function ResumeSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    function RedirectLogin() {
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
