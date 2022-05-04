<?php
    if (!empty($_POST['num']) && !empty($_POST['contenuMessage']) && (!empty($_POST['idSujetForum']))) {
        //Connexion à la BDD
        include_once('../../ALL/PHP/BDD.php');

        //Récupère l'état résolu du sujet
        $prepared = $pdo->prepare("SELECT resolu FROM sujetforum WHERE idSujetForum = :idSujetForum", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('idSujetForum' => $_POST['idSujetForum']));
        $rows = $prepared->fetchAll();
        $resolu = $rows[0][0];
        
        //Envoie le message seulement si le sujet n'est pas résolu
        if (!$resolu) {
            $prepared = $pdo->prepare("INSERT INTO messageforum VALUES (NULL, :contenuMessage, now(), :idSujetForum, :num)", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $prepared->execute(array('contenuMessage' => $_POST['contenuMessage'], 'idSujetForum' => $_POST['idSujetForum'], 'num' => $_POST['num']));
        }
    }
?>
