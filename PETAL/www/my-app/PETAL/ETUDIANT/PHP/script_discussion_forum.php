<?php
    //Connexion à la BDD
    include_once('../../ALL/PHP/BDD.php');

    function RedirectListeSujets() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        global $pdo;

        //Si sujet n'est pas défini
        if (empty($_GET['sujet'])) {
            header('location: liste_sujets_forum.php');
            exit;
        }

        //Si l'étudiant n'a pas accès à la matière du sujet, redirection à la liste des sujets
        $prepared = $pdo->prepare("SELECT utilisateur.num, utilisateur.nom, utilisateur.prenom, dateHeure, contenuMessage, nomSujet, nomMatiere FROM utilisateur NATURAL JOIN messageforum JOIN listesujets ON messageforum.idSujetForum = listesujets.idSujetForum WHERE nomMatiere IN (SELECT nomMatiere FROM etumatiere WHERE num = :num) && listesujets.idSujetForum = :idSujetForum ORDER BY dateHeure;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('num' => $_SESSION['num'], 'idSujetForum' => $_GET['sujet']));

        global $rowsMessages;
        $rowsMessages = $prepared->fetchAll();

        if (count($rowsMessages) == 0) {
            header('location: liste_sujets_forum.php');
            exit;
        }
    }

    function ListeCours() {
        global $pdo;

        $prepared = $pdo->prepare("SELECT nomMatiere FROM etumatiere WHERE num = :num;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('num' => $_SESSION['num']));
        $rows = $prepared->fetchAll();

        //Récupère toutes les matières dont l'étudiant a accès
        $liste = array();
        foreach ($rows as $row) {
            array_push($liste, '<li><a href="liste_sujets_forum.php?matiere='.$row[0].'">'.$row[0].'</a></li>');
        }

        //Propose de revenir au cours de la matière du sujet selectionné
        global $rowsMessages;
        global $nomMatiere;
        $nomMatiere = $rowsMessages[0][6];

        array_unshift($liste, '<li id="retour-cours"><a id="a-retour-cours" href="matiere.php?matiere='.$nomMatiere.'">Cours de '.$nomMatiere.'</a></li>');

        //Affiche la liste des cours
        foreach ($liste as $item) {
            echo $item;
        }
    }

    function BandeauHaut() {
        global $nomMatiere;
        global $rowsMessages;

        echo '<div class="retour-liste">
            <a id="a-retour-liste" href="liste_sujets_forum.php?matiere='.$nomMatiere.'">Sujets de '.$nomMatiere.'</a>
        </div>';

        echo '<div id="bandeau-sujet-nom-div">
            <span id="bandeau-sujet-nom-span">'.$rowsMessages[0][5].'</span>
        </div>';

        global $pdo;
        $prepared = $pdo->prepare("SELECT num, resolu FROM sujetforum WHERE idSujetForum = :idSujetForum;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('idSujetForum' => $_GET['sujet']));
        $rows = $prepared->fetchAll();

        global $possedeSujet;
        $possedeSujet = $rows[0][0] == $_SESSION['num'];
        global $resolu;
        $resolu = $rows[0][1];

        echo '<div id="bandeau-sujet-resolu">';
            echo '<span>Résolu : </span>';

            //Permet de changer de non_résolu en résolu mais pas dans l'autre sens
            if ($resolu) {
                echo '<img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/>';
            } else {
                if ($possedeSujet) {
                    echo '<img id="img-resolu-interactible" src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px" onclick="AppliquerResolu()" onmouseover="ChangerImgResolu(true)" onmouseout="ChangerImgResolu(false)"/>';
                } else {
                    echo '<img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/>';
                }
            }
        echo '</div>';
    }

    function Messages() {
        global $rowsMessages;
        foreach ($rowsMessages as $row) {
            if ($row[0] == $_SESSION['num']) {
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
    }

    function BandeauEnvoyerMessage() {
        global $resolu;
        if (!$resolu) {
            echo '<div id="envoyer-message">
                <span id="envoyer-message-span">Poster un message :</span>
                <textarea id="envoyer-message-texte" maxlength="2000"></textarea>
                <button id="envoyer-message-bouton" onclick="EnvoyerMessage()">Envoyer</button>
            </div>';
        }
    }

    function BalisesScript() {
        global $resolu;
        if (!$resolu) {
            echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="../JS/discussion_forum.js"></script>
            <script>SetNumeroEtudiant('.$_SESSION['num'].');</script>';
        }
    }
?>