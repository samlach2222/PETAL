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
            echo "<script>console.log(".$row[0].");</script>";
        }
        for ($i=1; $i <= $nbQ; $i++) { 
            $idQ=current($list);
            next($list);
            $query=$pdo->prepare("SELECT idQuestion,intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM FROM question WHERE idQCM=:idQCM AND idQuestion=:idQuestion");
            $query->execute(array('idQCM' => $_GET['id'], 'idQuestion' => $idQ));
            $rows=$query->fetchAll();
            foreach ($rows as $row) {
                echo "
                    <div class=\"question\" id=\"q".$idQ."\">
                        <label>Question </label>
                        <output id=\"out".$idQ."\">".$i."</output>
                        <label> : </label>
                        <input type=\"text\" name=\"intitule".$idQ."\" id=\"intitule".$idQ."\" value=\"".$row[1]."\">   
                ";
                /*<input type=\"button\" onclick=\"AjoutImageQCM(this.id)\" class=\"BtAjoutImage\" id=\"bt".$idQ."\" value=\"Ajout image\" name=\"ajoutImage\">
                if ($row[2]==NULL) {
                    echo "<input type=\"hidden\" id=\"b64Image".$idQ."\" name=\"b64Image".$idQ."\" value=\"\"><br>";}
                else{
                    echo "<input id=\"b64Image".$idQ."\" name=\"b64Image".$idQ."\" value=\"".$row[2]."\"><br>";
                }*/
                echo "<br><div id=\"reponses".$idQ."\">";
                if ($row[3]==1) {
                    echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" checked=\"true\" onclick=\"reponse(1,".$idQ.")\">
                        <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" onclick=\"reponse(2,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" onclick=\"reponse(3,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\"><br>";
                }
                elseif ($row[3]==2) {
                    echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" onclick=\"reponse(1,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" checked=\"true\" onclick=\"reponse(2,".$idQ.")\">
                        <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" onclick=\"reponse(3,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\"><br>";
                }
                elseif ($row[3]==3) {
                    echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" onclick=\"reponse(1,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" onclick=\"reponse(2,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" checked=\"true\" onclick=\"reponse(3,".$idQ.")\">
                        <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\"><br>";
                }
                else{
                    echo "<input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."a\" onclick=\"reponse(1,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."a\" id=\"reponse".$idQ."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."b\" onclick=\"reponse(2,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."b\" id=\"reponse".$idQ."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$idQ."\" id=\"reponseRB".$idQ."c\" onclick=\"reponse(3,".$idQ.")\" >
                        <input type=\"text\" name=\"reponse".$idQ."c\" id=\"reponse".$idQ."c\" value=\"".$row[6]."\"><br>";
                }
                echo "</div>
                    <input type=\"hidden\" id=\"reponseQ".$idQ."\" name=\"reponseQ".$idQ."\">
                    <input type=\"hidden\" id=\"idQ".$idQ."\" name=\"idQ".$idQ."\" value=\"".$idQ."\">
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
        $query=$pdo->prepare("SELECT nomQCM, dateHeureFin, nomMatiere, idQCM FROM QCM WHERE idQCM = :idQCM");
        $query->execute(array('idQCM' => $_GET['id']));
        $rows=$query->fetchAll();
        foreach ($rows as $row) { // modification des champs
            $nomQCM = $row[0];
            $dateHeureFin = $row[1];
            $nomMatiere = $row[2];
            echo "<td>
                    <label>Nom</label>
                    <input type=\"text\" required id=\"nom\" name=\"nom\" value=\"".$row[0]."\">
                </td>
                <td>
                    <label>Matière</label>
                    <input type=\"text\" required name=\"matiere\" id=\"matiere\" value=\"".$row[2]."\">
                </td>
                <td>
                    <label>Date/heure de fin</label>
                    <input type=\"date\" name=\"dateHeureFin\" id=\"dateHeureFin\" value=\"".$row[1]."\">
            </td>";
        }
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
        if (isset($_POST['idQCM'])) { // mode ajout
            echo "<script>console.log(\"ajout\")</script>";
            for ($i=1; $i <= $nbQuestion; $i++) { 
                array_push($intitule, $_POST['intitule'.$i]);
                array_push($choix1, $_POST['reponse'.$i.'a']);
                array_push($choix2, $_POST['reponse'.$i.'b']);
                array_push($choix3, $_POST['reponse'.$i.'c']);
                $reponseQuestion=$_POST['reponseQ'.$i];
                array_push($reponseALaQuestion, $reponseQuestion);
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
                        $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitulé, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                        $executed = $statement->execute([
                            'intitulé' => current($intitule),
                            'image' => NULL,
                            'reponseALaQuestion' => current($reponseALaQuestion),
                            'choix1' => current($choix1),
                            'choix2' => current($choix2),
                            'choix3' => current($choix3),
                            'idQCM' => $idQCM
                        ]);
                        next($intitule);
                        next($reponseALaQuestion);
                        next($choix1);
                        next($choix2);
                        next($choix3);
                    }
                    header("Location: ../HTML/liste_qcm.php?ajout=success");
                }
                else
                {
                    header("Location: ../HTML/liste_qcm.php?ajout=erroR");
                }
            }
        } else { // mode modification
            
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
                for ($i=1; $i <= $nbQuestion; $i++) { 
                    $idQ=current($list);
                    next($list);
                    array_push($intitule, $_POST['intitule'.$idQ]);
                    array_push($choix1, $_POST['reponse'.$idQ.'a']);
                    array_push($choix2, $_POST['reponse'.$idQ.'b']);
                    array_push($choix3, $_POST['reponse'.$idQ.'c']);
                    $reponseQuestion=$_POST['reponseQ'.$idQ];
                    array_push($reponseALaQuestion, $reponseQuestion);
                }
                
                if ($nbQuestion<=0 && $isPublier==1) {
                    header("Location: ../HTML/liste_qcm.php?modification=erreur");
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
                    for ($i=1; $i <= $nbQuestion; $i++) { 
                        $statement = $pdo->prepare('UPDATE question SET intitulé=:intitulé, image=:image, reponseALaQuestion=:reponseALaQuestion, choix1=:choix1,choix2=:choix2,choix3=:choix3 WHERE idQCM=:idQCM');
                        $executed = $statement->execute([
                            'intitulé' => current($intitule),
                            'image' => NULL,
                            'reponseALaQuestion' => current($reponseALaQuestion),
                            'choix1' => current($choix1),
                            'choix2' => current($choix2),
                            'choix3' => current($choix3),
                            'idQCM' => $idQCM
                        ]);
                        next($intitule);
                        next($reponseALaQuestion);
                        next($choix1);
                        next($choix2);
                        next($choix3);
                    }
                    header("Location: ../HTML/liste_qcm.php?modification=success");
                }
            }
            
        }
    }
?>