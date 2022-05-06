<?php
    //Connexion à la BDD
    include_once('../../ALL/PHP/BDD.php');

    //Récupère l'état résolu du sujet
    $prepared = $pdo->prepare("SELECT resolu FROM sujetforum WHERE idSujetForum = :idSujetForum", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $prepared->execute(array('idSujetForum' => $_POST['idSujetForum']));
    $rows = $prepared->fetchAll();
    $resolu = $rows[0][0];

    if ($resolu) {
        echo '<div id="messages" resolu="true">';
    } else {
        echo '<div id="messages">';   
    }

    $prepared = $pdo->prepare("SELECT utilisateur.num, nom, prenom, dateHeure, contenuMessage FROM utilisateur RIGHT JOIN messageforum ON utilisateur.num = messageforum.num WHERE idSujetForum = :idSujetForum ORDER BY dateHeure;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $prepared->execute(array('idSujetForum' => $_POST['idSujetForum']));
    $rows = $prepared->fetchAll();

    foreach ($rows as $row) {
        if ($row[0] == $_POST['num']) {
            echo '<div class="message-envoye">';
        } else {
            echo '<div class="message-recu">';
        }

                echo '<div class="message-entete">';
                    //Affiche étudiant supprimé si c'est le cas
                    if ($row[0]) {
                        echo '<span class="message-nom">'.ucfirst(mb_strtolower($row[2], 'UTF-8')).' '.mb_strtoupper($row[1], 'UTF-8').'</span>';
                    } else {
                        echo '<span class="message-nom">Utilisateur supprimé</span>';
                    }
                    echo '<span class="message-date">'.$row[3].'</span>';
                echo '</div>
                <div class="message-contenu">'.$row[4].'</div>';

        echo '</div>';
    }

    echo '</div>';
?>
