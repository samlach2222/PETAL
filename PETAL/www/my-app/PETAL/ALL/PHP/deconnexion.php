<?php
    // Initialize the session
    session_start();

    // Détruit le cookie user_souvenir si il existe
    if (isset($_COOKIE['user_souvenir'])) {
        unset($_COOKIE['user_souvenir']);
        setcookie('user_souvenir', '', null, '/my-app/PETAL/ALL'); // empty value and old timestamp
    }
 
    // Unset all of the session variables
    $_SESSION = array();
 
    // Destroy the session.
    session_destroy();
 
    // Redirect to login page
    header("location: ../HTML/connexion.php");
    exit;
?>
