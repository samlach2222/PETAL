<?php
    session_start();
    include('connexion.html');

    try
    {
        $conn = new PDO('mysql:host=localhost;dbname=petal_db','root', 'root');    
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    

    if(isset($_POST['nom_user']) && isset($_POST['mdp']))
    {
        //echo $_POST['nom_user']." ".$_POST['mdp'];
        $_SESSION['nom_user'] = $_POST['nom_user'];
        $_SESSION['mdp'] = $_POST['mdp'];
    }
?>

