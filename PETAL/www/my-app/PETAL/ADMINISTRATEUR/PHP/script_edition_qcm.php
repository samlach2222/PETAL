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
        echo "value='".$nb."'";
    } else {
        echo "value='0'";
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
            foreach ($rows as $row) {
                echo "
                    <div class='question' id='q".$idQ."'>
                        <label>Question </label>
                        <output id='out".$idQ."'>".$i."</output>
                        <label> : </label>
                        <input type='text' name='intitule".$idQ."' id='intitule".$idQ."' value=''".$row[1]."'>
                        <input type='button' onclick='AjoutImageQCM(this.id)' class='BtAjoutImage' id='bt".$idQ."' value='Ajout image' name='ajoutImage'>   
                ";
                if ($row[2]==NULL) {
                    echo "<img id='Image".$idQ."' class=\"imageHidden\"><br>";
                    echo "<input type=\"hidden\" id='Himage".$idQ."' value=\"\">";
                }
                else{
                    echo "</br><img id='Image".$idQ."' src='data:image;base64,".base64_encode($row[2])."'><br>";
                    echo "<input type=\"hidden\" id='Himage".$idQ."' value=\"".base64_encode($row[2])."\">";
                }
                echo "<br><div id='reponses".$idQ."'>";
                if ($row[3]==1) {
                    echo "<input type='radio' required name='reponse".$idQ."' id='reponseRB".$idQ."a' checked='true' onclick='reponse(1,".$idQ.")'>
                        <input type='text' name='reponse".$idQ."a' id='reponse".$idQ."a' value=''".$row[4]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."b' onclick='reponse(2,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."b' id='reponse".$idQ."b' value=''".$row[5]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."c' onclick='reponse(3,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."c' id='reponse".$idQ."c' value=''".$row[6]."'><br>";
                }
                elseif ($row[3]==2) {
                    echo "<input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."a' onclick='reponse(1,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."a' id='reponse".$idQ."a' value=''".$row[4]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."b' checked='true' onclick='reponse(2,".$idQ.")'>
                        <input type='text' name='reponse".$idQ."b' id='reponse".$idQ."b' value=''".$row[5]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."c' onclick='reponse(3,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."c' id='reponse".$idQ."c' value=''".$row[6]."'><br>";
                }
                elseif ($row[3]==3) {
                    echo "<input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."a' onclick='reponse(1,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."a' id='reponse".$idQ."a' value=''".$row[4]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."b' onclick='reponse(2,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."b' id='reponse".$idQ."b' value=''".$row[5]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."c' checked='true' onclick='reponse(3,".$idQ.")'>
                        <input type='text' name='reponse".$idQ."c' id='reponse".$idQ."c' value=''".$row[6]."'><br>";
                }
                else{
                    echo "<input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."a' onclick='reponse(1,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."a' id='reponse".$idQ."a' value=''".$row[4]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."b' onclick='reponse(2,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."b' id='reponse".$idQ."b' value=''".$row[5]."'><br>
                        <input type='radio' name='reponse".$idQ."' id='reponseRB".$idQ."c' onclick='reponse(3,".$idQ.")' >
                        <input type='text' name='reponse".$idQ."c' id='reponse".$idQ."c' value=''".$row[6]."'><br>";
                }
                echo "</div>
                    <input type='hidden' id='reponseQ".$idQ."' name='reponseQ".$idQ."'>
                    <input type='hidden' id='idQ".$idQ."' name='idQ".$idQ."' value=''".$idQ."'>
                </div>";
            }
        }
    }
}
function AfficheTitreQCM()
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
        $query=$pdo->prepare("SELECT nomQCM, idQCM FROM QCM WHERE idQCM = :idQCM");
        $query->execute(array('idQCM' => $_GET['id']));
        $rows=$query->fetchAll();
        foreach ($rows as $row) { // modification des champs
            echo "<td>
                    <label>Nom</label>
                    <input type=\"text\" required id=\"nom\" name=\"nom\" value=\"".$row[0]."\">
                </td>
                <td><label>Matière</label><select name=\"matiere\" id=\"matiere\">";    
        }
        $query=$pdo->prepare("SELECT nomMatiere FROM matiere");
        $query->execute();
        $rows=$query->fetchAll();
        foreach ($rows as $row) {
            echo "<option value=\"".$row[0]."\">".$row[0]."</option>";
        }
        $query=$pdo->prepare("SELECT dateHeureFin, idQCM FROM QCM WHERE idQCM = :idQCM");
        $query->execute(array('idQCM' => $_GET['id']));
        $rows=$query->fetchAll();
        foreach ($rows as $row) {
            echo"</select></td>
                <td>
                    <label>Date/heure de fin</label>
                    <input type=\"date\" name=\"dateHeureFin\" id=\"dateHeureFin\" value=\"".$row[0]."\">
            </td>";
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
                <input type=\"text\" required id=\"nom\" name=\"nom\" value=\"\">
            </td>
            <td><label>Matière</label><select name=\"matiere\" id=\"matiere\">";  
        $query=$pdo->prepare("SELECT nomMatiere FROM matiere");
        $query->execute();
        $rows=$query->fetchAll();
        foreach ($rows as $row) {
            echo "<option value=\"".$row[0]."\">".$row[0]."</option>";
        }
        echo"</select></td>
            <td>
                <label>Date/heure de fin</label>
                <input type=\"date\" name=\"dateHeureFin\" id=\"dateHeureFin\" value=\"\">
        </td>";
    }
}

    function EnvoiAjoutQCM($isPublier)
    {
        // Récupération des données
        $nomQCM = $_POST["nom"];
        $dateHeureFin = $_POST['dateHeureFin'];
        $nomMatiere = $_POST['matiere'];
        $nbQuestion=$_POST['nbQuestion'];
        $idQCM=$_POST['idQCM'];
        $intitule=array();
        $reponseALaQuestion=array();
        $choix1=array();
        $choix2=array();
        $choix3=array();
        $image=array();
        if ($idQCM==-1) { // mode ajout
            for ($i=1; $i <= $nbQuestion; $i++) { 
                array_push($intitule, $_POST['intitule'.$i]);
                array_push($choix1, $_POST['reponse'.$i.'a']);
                array_push($choix2, $_POST['reponse'.$i.'b']);
                array_push($choix3, $_POST['reponse'.$i.'c']);
                $reponseQuestion=$_POST['reponseQ'.$i];
                array_push($reponseALaQuestion, $reponseQuestion);
                if (empty($_POST['Himage'.$i])) {
                    array_push($image, "-1");
                } else {
                    array_push($image, $_POST['Himage'.$i]);
                }
            }

            // vérification des données
            if ($nomQCM == null|| $nomMatiere==NULL) {
                header("Location: ../HTML/edition_qcm.php?ajout=error");
            } 
            else {
                // Initialisation connexion BDD
                $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
                try {
                    $pdo = new PDO($dsn, "root", "root");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                if ($dateHeureFin=="") {
                    $dateHeureFin=NULL;
                }
                // Requete d'insertion
                $statement = $pdo->prepare('INSERT INTO QCM (nomQCM, dateHeureFin,evalue, publie, nomMatiere) VALUES (:nomQCM, :dateHeureFin, :evalue, :publie, :nomMatiere)');
                $executed = $statement->execute([
                    'nomQCM' => $nomQCM,
                    'dateHeureFin' => $dateHeureFin,
                    'evalue'=>1,
                    'publie' => $isPublier,
                    'nomMatiere' => $nomMatiere
                ]);
                if($executed){ // si la requête n'a pas pu être passée
                    $idQCM=$pdo->lastInsertId();
                    for ($i=1; $i <= $nbQuestion; $i++) { 
                        if ($nbQuestion!=0) {
                            if (current($image)=="-1") {
                                $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitulé, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                                $executed = $statement->execute([
                                    'intitulé' => current($intitule),
                                    'image' => NULL,
                                    'reponseALaQuestion' => current($reponseALaQuestion),
                                    'choix1' => current($choix1),
                                    'choix2' => current($choix2),
                                    'choix3' => current($choix3),
                                    'idQCM'=>$idQCM
                                ]);
                            } else {
                                $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitulé, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                                $executed = $statement->execute([
                                    'intitulé' => current($intitule),
                                    'image' => base64_decode(current($image)),
                                    'reponseALaQuestion' => current($reponseALaQuestion),
                                    'choix1' => current($choix1),
                                    'choix2' => current($choix2),
                                    'choix3' => current($choix3),
                                    'idQCM'=>$idQCM
                                ]);
                            }
                            next($intitule);
                            next($reponseALaQuestion);
                            next($choix1);
                            next($choix2);
                            next($choix3);
                            next($image);
                        } 
                        
                    }
                    header("Location: ../HTML/liste_qcm.php?ajout=success");
                }
                else
                {
                    header("Location: ../HTML/liste_qcm.php?ajout=error");
                }
            }
        }
        else { // mode modification
            $idQCM=$_POST['idQCM'];
            // vérification des données
            if ($nomQCM == null|| $nomMatiere==NULL) {
                header("Location: ../HTML/edition_qcm.php?modification=error");
            } 
            else {
                // Initialisation connexion BDD
                $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
                try {
                    $pdo = new PDO($dsn, "root", "root");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                if ($dateHeureFin=="") {
                    $dateHeureFin=NULL;
                }
                $list=array();
                $query="SELECT idQuestion, idQCM FROM Question WHERE idQCM=".$idQCM;
                foreach ($pdo->query($query) as $row) { 
                    array_push($list, $row[0]);
                }
                if ($nbQuestion!=0) {
                    $listeQ=array();
                    for ($i=1; $i <= $nbQuestion; $i++) { 
                        if (count($list)==0) {
                            $idQ=$i;
                            array_push($listeQ, $idQ);
                            array_push($intitule, $_POST['intitule'.$idQ]);
                            array_push($choix1, $_POST['reponse'.$idQ.'a']);
                            array_push($choix2, $_POST['reponse'.$idQ.'b']);
                            array_push($choix3, $_POST['reponse'.$idQ.'c']);
                            $reponseQuestion=$_POST['reponseQ'.$idQ];
                            array_push($reponseALaQuestion, $reponseQuestion);
                            if (empty($_POST['Himage'.$idQ])) {
                                array_push($image, "-1");
                            } else {
                                array_push($image, $_POST['Himage'.$idQ]);
                            }
                        } else {
                            $idQ=current($list);
                            if (end($list)==$idQ) {
                                if ($i==$nbQuestion) {
                                    $i=$nbQuestion+1;
                                }
                                else
                                {
                                    $idQ=$i;
                                    array_push($listeQ, $idQ);
                                }
                            }
                            else
                            {
                                next($list);
                            }
                            array_push($intitule, $_POST['intitule'.$idQ]);
                            array_push($choix1, $_POST['reponse'.$idQ.'a']);
                            array_push($choix2, $_POST['reponse'.$idQ.'b']);
                            array_push($choix3, $_POST['reponse'.$idQ.'c']);
                            $reponseQuestion=$_POST['reponseQ'.$idQ];
                            array_push($reponseALaQuestion, $reponseQuestion);
                            if (empty($_POST['Himage'.$idQ])) {
                                array_push($image, "-1");
                            } else {
                                array_push($image, $_POST['Himage'.$idQ]);
                            }
                        }
                        
                    }
                }
                
                if ($nbQuestion<=0 && $isPublier==1) {
                    header("Location: ../HTML/edition_qcm.php?modification=error");
                }
                else
                {
                    // Requete d'insertion
                    $statement = $pdo->prepare('UPDATE QCM SET nomQCM=:nomQCM, dateHeureFin=:dateHeureFin,evalue=:evalue, publie=:publie, nomMatiere=:nomMatiere WHERE idQCM=:idQCM');
                    $executed = $statement->execute([
                        'nomQCM' => $nomQCM,
                        'dateHeureFin' => $dateHeureFin,
                        'evalue'=>1,
                        'publie' => $isPublier,
                        'nomMatiere' => $nomMatiere,
                        'idQCM' => $idQCM
                    ]);
                    for ($i=0; $i < count($list); $i++) { 
                        if (current($image)=="-1") {
                                $statement = $pdo->prepare('UPDATE question SET intitulé=:intitulé, image=:image, reponseALaQuestion=:reponseALaQuestion, choix1=:choix1,choix2=:choix2,choix3=:choix3 WHERE idQCM=:idQCM AND idQuestion=:idQuestion');
                                $executed = $statement->execute([
                                    'intitulé' => current($intitule),
                                    'image' => NULL,
                                    'reponseALaQuestion' => current($reponseALaQuestion),
                                    'choix1' => current($choix1),
                                    'choix2' => current($choix2),
                                    'choix3' => current($choix3),
                                    'idQCM' => $idQCM,
                                    'idQuestion'=>current($list)
                                ]);
                            } else {
                                $statement = $pdo->prepare('UPDATE question SET intitulé=:intitulé, image=:image, reponseALaQuestion=:reponseALaQuestion, choix1=:choix1,choix2=:choix2,choix3=:choix3 WHERE idQCM=:idQCM AND idQuestion=:idQuestion');
                                $executed = $statement->execute([
                                    'intitulé' => current($intitule),
                                    'image' => base64_decode(current($image)),
                                    'reponseALaQuestion' => current($reponseALaQuestion),
                                    'choix1' => current($choix1),
                                    'choix2' => current($choix2),
                                    'choix3' => current($choix3),
                                    'idQCM' => $idQCM,
                                    'idQuestion'=>current($list)
                                ]);
                            }
                            if ($i!=count($list)-1) {
                                next($intitule);
                                next($reponseALaQuestion);
                                next($choix1);
                                next($choix2);
                                next($choix3);
                                next($image);
                                next($list);
                            }
                    }
                    for ($i=0; $i < count($listeQ); $i++) { 
                        $idQ=current($listeQ);
                        if (current($image)=="-1") { 
                            $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitulé, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                            $executed = $statement->execute([
                                'intitulé' => current($intitule),
                                'image' => NULL,
                                'reponseALaQuestion' => current($reponseALaQuestion),
                                'choix1' => current($choix1),
                                'choix2' => current($choix2),
                                'choix3' => current($choix3),
                                'idQCM'=>$idQCM
                            ]);
                        } else {
                            $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitulé, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                            $executed = $statement->execute([
                                'intitulé' => current($intitule),
                                'image' => base64_decode(current($image)),
                                'reponseALaQuestion' => current($reponseALaQuestion),
                                'choix1' => current($choix1),
                                'choix2' => current($choix2),
                                'choix3' => current($choix3),
                                'idQCM'=>$idQCM
                            ]);
                        }
                        
                        if ($i!=$count($listeQ)-1) {
                            next($intitule);
                            next($reponseALaQuestion);
                            next($choix1);
                            next($choix2);
                            next($choix3);
                            next($image);
                            next($listeQ);
                        }
                    }
                    header("Location: ../HTML/liste_qcm.php?modification=success");
                }
            }
            
        }
    }
?>