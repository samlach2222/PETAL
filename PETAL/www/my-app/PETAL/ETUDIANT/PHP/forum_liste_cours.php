<?php
    include_once('../../ALL/PHP/BDD.php');

    $prepared = $pdo->prepare("SELECT nomMatiere FROM etumatiere WHERE num = :num;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $prepared->execute(array('num' => $_SESSION['num']));
    $rows = $prepared->fetchAll();

    //Récupère toutes les matières dont l'étudiant a accès
    $liste = array();
    $aAcces = false;
    foreach ($rows as $row) {
        array_push($liste, '<li><a href="?matiere='.$row[0].'">'.$row[0].'</a></li>');
        
        if (isset($_GET['matiere']) && $_GET['matiere'] == $row[0]){
            $aAcces = true;
        }
    }

    //Si la matière selectionné est valide, affiche un message pour revenir à la liste des cours
    if ($aAcces) {
        array_unshift($liste, '<li id="retour-cours"><a id="a-retour-cours" href="matiere.php?matiere='.$_GET['matiere'].'">Cours de '.$_GET['matiere'].'</a></li>');
    }

    //Affiche la liste des cours
    foreach ($liste as $item) {
        echo $item;
    }
?>
