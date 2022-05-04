<?php
    if (!empty($_POST['num']) && !empty($_POST['contenuMessage']) && (!empty($_POST['idSujetForum']))) {
        //Connexion à la BDD
        include_once('../../ALL/PHP/BDD.php');

        $prepared = $pdo->prepare("INSERT INTO messageforum VALUES (NULL, :contenuMessage, now(), :idSujetForum, :num)", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('contenuMessage' => $_POST['contenuMessage'], 'idSujetForum' => $_POST['idSujetForum'], 'num' => $_POST['num']));
    }
?>
