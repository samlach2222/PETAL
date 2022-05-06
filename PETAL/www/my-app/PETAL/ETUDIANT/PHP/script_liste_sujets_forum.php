<?php
    //Connexion à la BDD
    include_once('../../ALL/PHP/BDD.php');

    function CreateSujet() {
        if (!empty($_POST['titre']) && !empty($_POST['message'])) {
            //Reprend la session
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            global $pdo;
            
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
    }

    function ListeCours() {
        global $pdo;
        
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
        
        $GLOBALS['aAcces'] = $aAcces;
    }

    function ListeSujets() {
        if ($GLOBALS['aAcces']) {
            //Affiche les sujets de la matière
            echo '<div>';
            
            global $pdo;
            
            $prepared = $pdo->prepare("SELECT idSujetForum, nomSujet, nom, prenom, nbMessages, resolu, num FROM listesujets WHERE nomMatiere = :nomMatiere;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $prepared->execute(array('nomMatiere' => $_GET['matiere']));
            $rows = $prepared->fetchAll();

            if (count($rows) > 0) {
                echo '<table id="tableau-sujets">
                    <tr>
                        <th>Sujet</th>
                        <th>Lancé par</th>
                        <th>Nombre de réponses</th>
                        <th>Résolu</th>
                    </tr>';
                foreach ($rows as $row){
                    echo '<tr>';
                    echo '<td><a href="discussion_forum.php?sujet='.$row[0].'">'.$row[1].'</a></td>';
                    
                    //Affiche étudiant supprimé si c'est le cas
                    if ($row[6]) {
                        //Affiche le nom en gras si c'est celui de l'étudiant connecté
                        $nom = ucfirst(mb_strtolower($row[3], 'UTF-8')).' '.mb_strtoupper($row[2], 'UTF-8');
                        if ($row[6] == $_SESSION['num']) {
                            echo '<td><b>'.$nom.'</b></td>';
                        } else {
                            echo '<td>'.$nom.'</td>';
                        }
                    } else {
                        echo '<td>Utilisateur supprimé</td>';
                    }
                    
                    
                    echo '<td>'.$row[4].'</td>';

                    //Icône résolu
                    if ($row[5]) {
                        echo '<td><img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/></td>';
                    } else {
                        echo '<td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }

            echo '</div>';


            //Affiche le bandeau du bas pour créer un nouveau sujet
            echo '<div id="creer-sujet">
                <form method="POST">
                    <span id="creer-sujet-span">Créer un nouveau sujet :</span>
                    <input id="creer-sujet-titre" name="titre" placeholder="Titre" maxlength="50" required></input>
                    <textarea id="creer-sujet-message" name="message" placeholder="Message" maxlength="2000" required></textarea>
                    <button id="creer-sujet-bouton" type="submit">Créer sujet</button>
                </form>
            </div>';
        } else {
            //Affiche un message disant de sélectionner une matière
            echo '<span id="message-selection-sujet">← Veuillez sélectionner une matière</span>';
        }
    }
?>