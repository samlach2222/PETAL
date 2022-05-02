<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/liste_sujets_forum_dark.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des sujet du forum</title>
</head>
<body>
    <?php
        if (!empty($_POST['titre']) && !empty($_POST['message'])) {
            //Reprend la session
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            //Connexion à la BDD
            include_once('../../ALL/PHP/BDD.php');
            
            $prepared = $pdo->prepare("INSERT INTO sujetforum VALUES (NULL, :nomSujet, '0', :nomMatiere, :num)", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $executed = $prepared->execute(array('nomSujet' => $_POST['titre'], 'nomMatiere' => $_GET['matiere'], 'num' => $_SESSION['num']));
            
            if ($executed){
                $insertedSujetId = $pdo->lastInsertId();
                
                $prepared = $pdo->prepare("INSERT INTO messageforum VALUES (NULL, :contenuMessage, FROM_UNIXTIME(:dateHeure), :idSujetForum, :num)", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $executed = $prepared->execute(array('contenuMessage' => $_POST['message'], 'dateHeure' => time(), 'idSujetForum' => $insertedSujetId, 'num' => $_SESSION['num']));
                
                if ($executed) {
                    //Redirection vers le nouveau sujet
                    header('location: discussion_forum.php?sujet='.$insertedSujetId);
                    exit;
                } else {
                    //Suppression de la ligne sujetforum créé
                    $prepared = $pdo->prepare("DELETE FROM sujetforum WHERE idSujetForum = :idSujetForum", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $prepared->execute(array('idSujetForum' => $insertedSujetId));
                }
            }
        }
    ?>
    <?php include("../../ALL/HTML/bandeau.html"); ?>
    <div id="content">
        <div id="gauche-cours">
            <ul id="liste-cours">
                <?php include('../PHP/forum_liste_cours.php'); ?>
            </ul>
        </div>
        <div id="droite-sujets">
            <?php include('../PHP/forum_liste_sujets.php'); ?>
        </div>
    </div>
</body>
</html>

<script src="../JS/liste_sujets_forum.js"></script>
