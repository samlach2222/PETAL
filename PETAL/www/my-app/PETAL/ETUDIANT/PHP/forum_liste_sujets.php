<?php
    include_once('../../ALL/PHP/BDD.php');

    if ($aAcces) {
        //Affiche les sujets de la matière
        echo '<div>';
        
        $prepared = $pdo->prepare("SELECT idSujetForum, nomSujet, nom, prenom, nbMessages, resolu FROM listesujets WHERE nomMatiere = :nomMatiere;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
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
                echo '<td>'.$row[3].' '.mb_strtoupper($row[2], 'UTF-8').'</td>';
                echo '<td>'.$row[4].'</td>';

                //Icône résolu
                if ($row[5]) {
                    //TODO: Récupèrer le thème actuellement selectionné (faudra aussi mettre les résolus à jour quand on change de thème)
                    $dark = true;

                    if ($dark) {
                        echo '<td><img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/></td>';
                    } else {
                        echo '<td><img src="../../Ressources/Pictures/résolu_light.png" width="40px" height="40px"/></td>';
                    }
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
                <input id="creer-sujet-titre" name="titre" placeholder="Titre"></input>
                <textarea id="creer-sujet-message" name="message" placeholder="Message"></textarea>
                <button id="creer-sujet-bouton" type="submit">Créer sujet</button>
            </form>
        </div>';
    } else {
        //Affiche un message disant de sélectionner une matière
        echo '<span id="message-selection-sujet">← Veuillez sélectionner une matière</span>';
    }
?>
