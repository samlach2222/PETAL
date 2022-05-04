<?php
    //Connexion à la BDD
    include_once('../../ALL/PHP/BDD.php');

    //Si l'étudiant n'a pas accès à la matière du sujet, redirection à la liste des sujets
    $prepared = $pdo->prepare("SELECT num, nom, prenom, dateHeure, contenuMessage FROM utilisateur NATURAL JOIN messageforum WHERE idSujetForum = :idSujetForum ORDER BY dateHeure;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $prepared->execute(array('idSujetForum' => $_POST['idSujetForum']));

    $rows = $prepared->fetchAll();

    foreach ($rows as $row) {
        if ($row[0] == $_POST['num']) {
            echo '<div class="message-envoye">';
        } else {
            echo '<div class="message-recu">';
        }

            echo '<div class="message-entete">
                <span class="message-nom">'.ucfirst(mb_strtolower($row[2], 'UTF-8')).' '.mb_strtoupper($row[1], 'UTF-8').'</span>
                <span class="message-date">'.$row[3].'</span>
            </div>
            <div class="message-contenu">'.$row[4].'</div>';

        echo '</div>';
    }
?>
