<?php
    // Quand on appuie sur le bouton valider
    if(isset($_POST['valider'])) {
        EnvoiAjoutQCM(0);
    }
    if(isset($_POST['publier'])) {
        EnvoiAjoutQCM(1);
    }
    
    // Si l'on reviens sur la même page avec une erreur d'insertion
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "error") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Erreur insertion");</script>';
        }
    }

function updateNbQuestion()
{
    if (!empty($_GET['id'])) {
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query="SELECT count(idQuestion), idQCM FROM Question WHERE idQCM=".$_GET['id'];
        foreach ($pdo->query($query) as $row) { 
            $nb = $row[0];
        }
        echo "value=\"".$nb."\"";
    } else {
        echo "value=\"0\"";
    }
    
}
function updateMatiere()
{
    if (!empty($_GET['id'])) {
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query="SELECT nomMatiere FROM QCM WHERE idQCM=".$_GET['id'];
        foreach ($pdo->query($query) as $row) { 
            $nom = $row[0];
        }
        echo "value=\"".$nom."\"";
    } else {
        echo "value=\"rien\"";
    }
    
}

function AfficheQCM()
{
    if(!empty($_GET['id'])) {
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        $_SESSION["idModif"] = $_GET['id'];
        // Requete de récupération de tout les utilisateurs
        $query = "SELECT nomQCM, dateHeureFin, nomMatiere, idQCM FROM QCM WHERE idQCM = " . $_GET['id'];

        foreach ($pdo->query($query) as $row) { // modification des champs
            $nomQCM = $row[0];
            $dateHeureFin = $row[1];
            $nomMatiere = $row[2];
        }
        //affichage des questions
        $query="SELECT count(idQuestion), idQCM FROM Question WHERE idQCM=".$_GET['id'];
        foreach ($pdo->query($query) as $row) { 
            $nbQ = $row[0];
        }
        $list=array();
        $query="SELECT idQuestion, idQCM FROM Question WHERE idQCM=".$_GET['id'];
        foreach ($pdo->query($query) as $row) { 
            array_push($list, $row[0]);
        }
        for ($i=1; $i <= $nbQ; $i++) { 
            $idQ=current($list);
            next($list);
            $query=$pdo->prepare("SELECT idQuestion,intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM FROM question WHERE idQCM=:idQCM AND idQuestion=:idQuestion");
            $query->execute(array('idQCM' => $_GET['id'], 'idQuestion' => $idQ));
            $rows=$query->fetchAll();
            
            global $publie;
            
            foreach ($rows as $row) {
                if ($publie) {
                    echo '<div class="question">
                            <label>Question '.$i.' : '.$row[1].'</label>';
                    if ($row[2]!=NULL) {
                        echo "<br/><img class='Image' id=\"Image".$idQ."\" src=\"data:image;base64,".base64_encode($row[2])."\"><br/>";
                    }
                    echo "<div id=\"reponses".$idQ."\">";
                    if ($row[3]==1) {
                        echo "<span id=\"reponse".$idQ."a\"><b>".$row[4]."</b></span><br>
                            <span id=\"reponse".$idQ."b\">".$row[5]."</span><br>
                            <span id=\"reponse".$idQ."c\">".$row[6]."</span><br>";
                    }
                    elseif ($row[3]==2) {
                        echo "<span id=\"reponse".$idQ."a\">".$row[4]."</span><br>
                            <span id=\"reponse".$idQ."b\"><b>".$row[5]."</b></span><br>
                            <span id=\"reponse".$idQ."c\">".$row[6]."</span><br>";
                    }
                    elseif ($row[3]==3) {
                        echo "<span id=\"reponse".$idQ."a\">".$row[4]."</span><br>
                            <span id=\"reponse".$idQ."b\">".$row[5]."</span><br>
                            <span id=\"reponse".$idQ."c\"><b>".$row[6]."</b></span><br>";
                    }
                    echo "</div>
                    </div>";
                } else {
                    echo "
                        <div class=\"question\" id=\"q".$idQ."\">
                            <label>Question </label>
                            <output id=\"out".$idQ."\">".$i."</output>
                            <label> : </label>
                            <input type=\"text\" name=\"intitule".$idQ."\" id=\"intitule".$idQ."\" value=\"".$row[1]."\" maxlength=\"300\">
                            <input type=\"button\" onclick=\"AjoutImageQCM(this.id)\" class=\"BtAjoutImage\" id=\"bt".$idQ."\" value=\"Ajout image\" name=\"ajoutImage\">
                    ";
                    if ($row[2]==NULL) {
                        echo "<img id='Image".$idQ."' class=\"imageHidden\"><br>";
                        echo "<input type=\"hidden\" id='Himage".$idQ."' name='Himage".$idQ."' value=\"-1\">";}
                    else{
                        echo "</br><img class='Image' id=\"Image".$idQ."\" src=\"data:image;base64,".base64_encode($row[2])."\"><br>";
                        echo "<input type=\"hidden\" id='Himage".$idQ."' name='Himage".$idQ."' value=\"".base64_encode($row[2])."\">";
                    }
                    echo "<div id=\"reponses".$idQ."\">";
                    if ($row[3]==1) {
                        echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" checked=\"true\" onclick=\"reponse(1,".$idQ.")\">
                            <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" onclick=\"reponse(2,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" onclick=\"reponse(3,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\" maxlength=\"150\"><br>";
                    }
                    elseif ($row[3]==2) {
                        echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" onclick=\"reponse(1,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" checked=\"true\" onclick=\"reponse(2,".$idQ.")\">
                            <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" onclick=\"reponse(3,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\" maxlength=\"150\"><br>";
                    }
                    elseif ($row[3]==3) {
                        echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" onclick=\"reponse(1,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" onclick=\"reponse(2,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" checked=\"true\" onclick=\"reponse(3,".$idQ.")\">
                            <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\" maxlength=\"150\"><br>";
                    }
                    else{
                        echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" onclick=\"reponse(1,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" onclick=\"reponse(2,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\" maxlength=\"150\"><br>
                            <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" onclick=\"reponse(3,".$idQ.")\" >
                            <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\" maxlength=\"150\"><br>";
                    }
                    echo "</div>
                        <input type=\"hidden\" id=\"reponseQ".$idQ."\" name=\"reponseQ".$idQ."\">
                        <input type=\"hidden\" id=\"idQ".$idQ."\" name=\"idQ".$idQ."\" value=\"".$idQ."\">
                    </div>";
                }
            }
        }
    }
}
function AfficheTitreQCM()
{
    // Affecte l'état publié du QCM dans une variable global pour la récupérer dans les autres fonctions
    global $publie;
    
    if(!empty($_GET['id'])) {
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        $_SESSION["idModif"] = $_GET['id'];
        // Requete de récupération de tout les utilisateurs
        $query=$pdo->prepare("SELECT nomQCM, dateHeureFin, nomMatiere, publie, idQCM FROM QCM WHERE idQCM = :idQCM");
        $query->execute(array('idQCM' => $_GET['id']));
        $rows=$query->fetchAll();
        
        $publie = $rows[0][3];
        
        // N'affiche pas des input si le QCM est publié
        if ($publie) {
            echo '<td>
                    <label>Nom</label><br/>
                    <span id="nom">'.$rows[0][0].'</span>
                </td>
                <td>
                    <label>Matière</label><br/>
                    <span id="matiere">'.$rows[0][2].'</span>
                </td>
                <td>
                    <label>Date/heure de fin</label><br/>
                    <span id="dateHeureFin">'.$rows[0][1].'</span>
                </td>';
        } else {
            foreach ($rows as $row) { // modification des champs
                echo "<td>
                        <label>Nom</label>
                        <input type=\"text\" required id=\"nom\" name=\"nom\" value=\"".$row[0]."\" maxlength=\"50\">
                    </td>
                    <td><label>Matière</label><select name=\"matiere\" id=\"matiere\" onclick=\"matiereSelect()\">
                    "; 
                $nomMatiere=$row[2];   
            }
            if ($nomMatiere=="rien") {
                echo "<option value=\"rien\" select=\"selected\">Sélectionner une matiere</option>";
            } else {
                echo "<option value=\"rien\">Sélectionner une matiere</option>";
            }

            $query=$pdo->prepare("SELECT nomMatiere FROM matiere");
            $query->execute();
            $rows=$query->fetchAll();
            foreach ($rows as $row) {
                if ($row[0]==$nomMatiere) {

                    echo "<option value=\"".$row[0]."\" selected=\"selected\">".$row[0]."</option>";
                } else {
                    echo "<option value=\"".$row[0]."\">".$row[0]."</option>";
                }
            }
            $query=$pdo->prepare("SELECT dateHeureFin, idQCM FROM QCM WHERE idQCM = :idQCM");
            $query->execute(array('idQCM' => $_GET['id']));
            $rows=$query->fetchAll();
            foreach ($rows as $row) {
                
                if ($row[0]) { // ne pas pré-remplir si dateHeureFin est null dans la BDD
                    echo"</select></td>
                        <td>
                            <label>Date/heure de fin</label>
                            <input type=\"datetime-local\" name=\"dateHeureFin\" id=\"dateHeureFin\" value=\"".date('Y-m-d\TH:i', strtotime($row[0]))."\">
                    </td>";   
                } else {
                    echo"</select></td>
                        <td>
                            <label>Date/heure de fin</label>
                            <input type=\"datetime-local\" name=\"dateHeureFin\" id=\"dateHeureFin\">
                    </td>";  
                }
            }
        }
    }
    else
    {
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        // Requete de récupération de tout les utilisateurs
        echo "<td>
                <label>Nom</label>
                <input type=\"text\" required id=\"nom\" name=\"nom\" value=\"\" maxlength=\"50\">
            </td>
            <td><label>Matière</label><select name=\"matiere\" id=\"matiere\" onclick=\"matiereSelect()\">
            <option value=\"rien\" select=\"selected\">Sélectionner une matiere</option>";  
        $query=$pdo->prepare("SELECT nomMatiere FROM matiere");
        $query->execute();
        $rows=$query->fetchAll();
        foreach ($rows as $row) {
            echo "<option name=\"\" value=\"".$row[0]."\">".$row[0]."</option>";
        }
        echo"</select></td>
            <td>
                <label>Date/heure de fin</label>
                <input type=\"datetime-local\" name=\"dateHeureFin\" id=\"dateHeureFin\" value=\"\">
        </td>";
        
        $publie = false;
    }
}

function EnvoiAjoutQCM($isPublier){
    // Récupération des données
    $nomQCM = $_POST["nom"];
    $dateHeureFin = $_POST['dateHeureFin'];
    $nomMatiere = $_POST['matiereSelectionner'];
    $nbQuestion=$_POST['nbQuestion'];//nombre de question total
    $nbAjoutQuestion=$_POST['nbAjoutQuestionJs'];//nombre de question ajoute en js

    if ($dateHeureFin=="") {
        $dateHeureFin=NULL;
    }
    if ($nomMatiere=="rien" && $isPublier==1) {
        $isPublier=0;
    }
    if ($isPublier==1 && $nbQuestion==0) {
        $isPublier=0;
    }
    // Initialisation connexion BDD
    $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
    try {
        $pdo = new PDO($dsn, "root", "root");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //si toutes les questions ne sont pas enregistrer dans la BDD
    if ($nbQuestion==$nbAjoutQuestion) {
        if ($nomQCM==NULL || $nomMatiere==NULL) {

            header("Location: ../HTML/edition_qcm.php?ajout=error");
        } else {
            if ($_POST['idQCM']==-1) {//mode ajout
                // Requete d'insertion
                $statement = $pdo->prepare('INSERT INTO QCM (nomQCM, dateHeureFin, publie, nomMatiere) VALUES (:nomQCM, :dateHeureFin, :publie, :nomMatiere)');
                $executed = $statement->execute([
                    'nomQCM' => $nomQCM,
                    'dateHeureFin' => $dateHeureFin,
                    'publie' => $isPublier,
                    'nomMatiere' => $nomMatiere
                ]);
                $etat="ajout";
                $idQCM=$pdo->lastInsertId();
            } else { //mode modification si aucune question avant dans la BDD
                $idQCM=$_POST['idQCM'];
                $statement = $pdo->prepare('UPDATE QCM SET nomQCM=:nomQCM, dateHeureFin=:dateHeureFin, publie=:publie, nomMatiere=:nomMatiere WHERE idQCM=:idQCM');
                $executed = $statement->execute([
                    'nomQCM' => $nomQCM,
                    'dateHeureFin' => $dateHeureFin,
                    'publie' => $isPublier,
                    'nomMatiere' => $nomMatiere,
                    'idQCM' => $idQCM
                ]);
                $etat="modification";
            }

            if ($executed) {
                if ($nbQuestion==0) {
                    header("Location: ../HTML/liste_qcm.php?publication=error");
                    exit;
                }
                
                for ($i=1; $i <= $nbQuestion; $i++) { 
                    $intitule=$_POST['intitule'.$i];
                    $image=$_POST['Himage'.$i];
                    $reponseALaQuestion=$_POST['reponseQ'.$i];
                    $choix1=$_POST['reponse'.$i.'a'];
                    $choix2=$_POST['reponse'.$i.'b'];
                    $choix3=$_POST['reponse'.$i.'c'];
                    if ($intitule=="") {
                        $intitule="N a pas été remplis précédemment";
                    }
                    if ($reponseALaQuestion=="") {
                        $reponseALaQuestion="1";
                    }
                    if ($choix1=="") {
                        $choix1="N a pas été remplis précédemment";
                    }
                    if ($choix2=="") {
                        $choix2="N a pas été remplis précédemment";
                    }
                    if ($choix3=="") {
                        $choix3="N a pas été remplis précédemment";
                    }
                    
                    if ($image=="-1") {
                        $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1, choix2, choix3, idQCM) VALUES (:intitule, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                        $executed = $statement->execute([
                            'intitule' => $intitule,
                            'image' => NULL,
                            'reponseALaQuestion' => $reponseALaQuestion,
                            'choix1' => $choix1,
                            'choix2' => $choix2,
                            'choix3' => $choix3,
                            'idQCM' => $idQCM
                        ]);

                    }else
                    {
                        $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitule, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                        $executed = $statement->execute([
                            'intitule' => $intitule,
                            'image' => base64_decode($image),
                            'reponseALaQuestion' => $reponseALaQuestion,
                            'choix1' => $choix1,
                            'choix2' => $choix2,
                            'choix3' => $choix3,
                            'idQCM' => $idQCM
                        ]);
                    }
                    
                }
                if ($executed) {
                    header("Location: ../HTML/liste_qcm.php?".$etat."=success");
                } else {
                    header("Location: ../HTML/liste_qcm.php?".$etat."=error");
                }
            } else {
                header("Location: ../HTML/liste_qcm.php?".$etat."=error");
            }
        }
        
    } else { //mode modification
        if ($nbQuestion<$nbAjoutQuestion) {
            header("Location: ../HTML/liste_qcm.php?modification=error");
        } else {
            if ($nomQCM==NULL || $nomMatiere==NULL) {
                header("Location: ../HTML/edition_qcm.php?modification=error");
            } else {
                if ($_POST['idQCM']==-1) {
                    header("Location: ../HTML/edition_qcm.php?modification=error");
                } else { //mode modification 
                    $idQCM=$_POST['idQCM'];
                    $statement = $pdo->prepare('UPDATE QCM SET nomQCM=:nomQCM, dateHeureFin=:dateHeureFin, publie=:publie, nomMatiere=:nomMatiere WHERE idQCM=:idQCM');
                    $executed = $statement->execute([
                        'nomQCM' => $nomQCM,
                        'dateHeureFin' => $dateHeureFin,
                        'publie' => $isPublier,
                        'nomMatiere' => $nomMatiere,
                        'idQCM' => $idQCM
                    ]);

                    if ($executed) {
                        //update
                            //affichage des questions
                            $query="SELECT count(idQuestion), idQCM FROM Question WHERE idQCM=".$idQCM;
                            foreach ($pdo->query($query) as $row) { 
                                $nbQ = $row[0];
                            }
                            $list=array();
                            $query="SELECT idQuestion, idQCM FROM Question WHERE idQCM=".$idQCM;
                            foreach ($pdo->query($query) as $row) { 
                                array_push($list, $row[0]);
                            }

                            for ($i=0; $i < $nbQ; $i++) { 
                                $idQ=current($list);
                                $intitule=$_POST['intitule'.$idQ];
                                $image=$_POST['Himage'.$idQ];
                                $reponseALaQuestion=$_POST['reponseQ'.$idQ];
                                $choix1=$_POST['reponse'.$idQ.'a'];
                                $choix2=$_POST['reponse'.$idQ.'b'];
                                $choix3=$_POST['reponse'.$idQ.'c'];
                                if ($intitule=="") {
                                    $intitule="N'a pas été remplis précédemment";
                                }
                                if ($reponseALaQuestion=="") {
                                    $reponseALaQuestion="1";
                                }
                                if ($choix1=="") {
                                    $choix1="N'a pas été remplis précédemment";
                                }
                                if ($choix2=="") {
                                    $choix2="N'a pas été remplis précédemment";
                                }
                                if ($choix3=="") {
                                    $choix3="N'a pas été remplis précédemment";
                                }
                                if ($image=="-1") {
                                    $image=NULL;
                                    $statement = $pdo->prepare('UPDATE question SET intitulé=:intitule, image=:image, reponseALaQuestion=:reponseALaQuestion, choix1=:choix1,choix2=:choix2,choix3=:choix3 WHERE idQCM=:idQCM AND idQuestion=:idQuestion');
                                    $executed = $statement->execute([
                                        'intitule' => $intitule,
                                        'image' => $image,
                                        'reponseALaQuestion' => $reponseALaQuestion,
                                        'choix1' => $choix1,
                                        'choix2' => $choix2,
                                        'choix3' => $choix3,
                                        'idQCM' => $idQCM,
                                        'idQuestion' => $idQ
                                    ]);
                                }else
                                {
                                    $statement = $pdo->prepare('UPDATE question SET intitulé=:intitule, image=:image, reponseALaQuestion=:reponseALaQuestion, choix1=:choix1,choix2=:choix2,choix3=:choix3 WHERE idQCM=:idQCM AND idQuestion=:idQuestion');
                                    $executed = $statement->execute([
                                        'intitule' => $intitule,
                                        'image' => base64_decode($image),
                                        'reponseALaQuestion' => $reponseALaQuestion,
                                        'choix1' => $choix1,
                                        'choix2' => $choix2,
                                        'choix3' => $choix3,
                                        'idQCM' => $idQCM,
                                        'idQuestion' => $idQ
                                    ]);
                                }
                                next($list);
                                
                            }
                        //insert
                            $debutInsert=$nbQ+1;
                            for ($i=$debutInsert; $i <= $nbQuestion; $i++) { 
                                $intitule=$_POST['intitule'.$i];
                                $image=$_POST['Himage'.$i];
                                $reponseALaQuestion=$_POST['reponseQ'.$i];
                                $choix1=$_POST['reponse'.$i.'a'];
                                $choix2=$_POST['reponse'.$i.'b'];
                                $choix3=$_POST['reponse'.$i.'c'];
                                if ($intitule=="") {
                                    $intitule="N'a pas été remplis précédemment";
                                }
                                if ($reponseALaQuestion=="") {
                                    $reponseALaQuestion="1";
                                }
                                if ($choix1=="") {
                                    $choix1="N'a pas été remplis précédemment";
                                }
                                if ($choix2=="") {
                                    $choix2="N'a pas été remplis précédemment";
                                }
                                if ($choix3=="") {
                                    $choix3="N'a pas été remplis précédemment";
                                }
                                if ($image=="-1") {
                                    $image=NULL;
                                    $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitule, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                                    $executed = $statement->execute([
                                        'intitule' => $intitule,
                                        'image' => $image,
                                        'reponseALaQuestion' => $reponseALaQuestion,
                                        'choix1' => $choix1,
                                        'choix2' => $choix2,
                                        'choix3' => $choix3,
                                        'idQCM' => $idQCM
                                    ]);
                                }else
                                {
                                    $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitule, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                                    $executed = $statement->execute([
                                        'intitule' => $intitule,
                                        'image' => base64_decode($image),
                                        'reponseALaQuestion' => $reponseALaQuestion,
                                        'choix1' => $choix1,
                                        'choix2' => $choix2,
                                        'choix3' => $choix3,
                                        'idQCM' => $idQCM
                                    ]);
                                }
                            }
                        if ($executed) {
                            header("Location: ../HTML/liste_qcm.php?modification=success");
                        } else {
                            header("Location: ../HTML/liste_qcm.php?modification=error");
                        }
                    } else {
                        header("Location: ../HTML/liste_qcm.php?modification=error");
                    }
                }
                
            }
        }
        
    }
    
}
function AfficheBoutonsBas()
{
    global $publie;
    
    if (!$publie) {
        echo '<div id="boutonBas">
                <input type="button" name="add" value="+" id="add" onclick="ajoutQuestion()" class="SecondButton">
                <input type="submit" class="SecondButton" name="valider" value="Valider" id="valider">
                <input type="submit" class="SecondButton" name="publier" value="Publier" id="publier">    
            </div>';   
    }
}

?>