<?php

    include_once('../../ALL/PHP/BDD.php');
    //var_dump($_SESSION['num']);

    $num = $_SESSION['num'];

    $req = $pdo->prepare('SELECT * FROM Utilisateur WHERE num = :num');
    $req->execute(array('num' => $num));
    $rows = $req->fetchAll();

    foreach ($rows as $row) {
        $_SESSION['num'] = $row[0];
        $_SESSION['admin'] = $row[1];
        $_SESSION['photoProfil'] = base64_encode($row[2]);
        $_SESSION['nom'] = ucfirst(mb_strtolower($row[4], 'UTF-8')).' '.mb_strtoupper($row[3], 'UTF-8');
        $_SESSION['adresseMail'] = $row[5];
        if ($row[6]) {
            $_SESSION['numTel'] = $row[6];
        } else {
            $_SESSION['numTel'] = 'Aucun';
        }
        $_SESSION['mdp'] = $row[7];
    }

?>