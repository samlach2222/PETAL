<?php
    // Quand on appuie sur le bouton valider
    if(isset($_POST['valider'])) {
        EnvoiAjoutQCM(0);
    }//pas fini
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
        for ($i=1; $i <= $nbQ; $i++) { 
            $query=$pdo->prepare("SELECT idQuestion,intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM FROM question WHERE idQCM=:idQCM AND idQuestion=:idQuestion");
            $query->execute(array('idQCM' => $_GET['id'], 'idQuestion' => $i));
            $rows=$query->fetchAll();
            foreach ($rows as $row) {
                echo "
                    <div class=\"question\" id=\"q".$row['idQuestion']."\">
                        <label>Question </label>
                        <output id=\"out".$row[0]."\">".$row['idQuestion']."</output>
                        <label> : </label>
                        <input type=\"text\" name=\"intitule".$row[0]."\" id=\"intitule".$row[0]."\" value=\"".$row[1]."\">
                        <input type=\"button\" onclick=\"AjoutImageQCM(this.id)\" class=\"BtAjoutImage\" id=\"bt".$row[0]."\" value=\"Ajout image\" name=\"ajoutImage\">
                ";
                if ($row[2]==NULL) {
                    echo "<input type=\"hidden\" id=\"b64Image".$row[0]."\" name=\"b64Image".$row[0]."\" value=\"\"><br>";}
                else{
                    echo "<input id=\"b64Image".$row[0]."\" name=\"b64Image".$row[0]."\" value=\"".$row[2]."\"><br>";
                }
                echo "<div id=\"reponses".$row[0]."\">";
                if ($row[3]==1) {
                    echo "<input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."a\" checked=\"true\" onclick=\"reponse(1,".$row[0].")\">
                        <input type=\"text\" name=\"reponse".$row[0]."a\" id=\"reponse".$row[0]."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."b\" onclick=\"reponse(2,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."b\" id=\"reponse".$row[0]."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."c\" onclick=\"reponse(3,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."c\" id=\"reponse".$row[0]."c\" value=\"".$row[6]."\"><br>";
                }
                elseif ($row[3]==2) {
                    echo "<input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."a\" onclick=\"reponse(1,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."a\" id=\"reponse".$row[0]."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."b\" checked=\"true\" onclick=\"reponse(2,".$row[0].")\">
                        <input type=\"text\" name=\"reponse".$row[0]."b\" id=\"reponse".$row[0]."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."c\" onclick=\"reponse(3,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."c\" id=\"reponse".$row[0]."c\" value=\"".$row[6]."\"><br>";
                }
                elseif ($row[3]==3) {
                    echo "<input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."a\" onclick=\"reponse(1,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."a\" id=\"reponse".$row[0]."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."b\" onclick=\"reponse(2,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."b\" id=\"reponse".$row[0]."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."c\" checked=\"true\" onclick=\"reponse(3,".$row[0].")\">
                        <input type=\"text\" name=\"reponse".$row[0]."c\" id=\"reponse".$row[0]."c\" value=\"".$row[6]."\"><br>";
                }
                else{
                    echo "<input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."a\" onclick=\"reponse(1,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."a\" id=\"reponse".$row[0]."a\" value=\"".$row[4]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."b\" onclick=\"reponse(2,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."b\" id=\"reponse".$row[0]."b\" value=\"".$row[5]."\"><br>
                        <input type=\"radio\" name=\"reponse".$row[0]."\" id=\"reponseRB".$row[0]."c\" onclick=\"reponse(3,".$row[0].")\" >
                        <input type=\"text\" name=\"reponse".$row[0]."c\" id=\"reponse".$row[0]."c\" value=\"".$row[6]."\"><br>";
                }
                echo "</div>
                    <input type=\"hidden\" id=\"reponseQ".$row[0]."\" name=\"reponseQ".$row[0]."\">
                    <input type=\"hidden\" id=\"idQ".$row[0]."\" name=\"idQ".$row[0]."\" value=\"".$row[0]."\">
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

        $intitule=array();
        $image=array();
        $reponseALaQuestion=array();
        $choix1=array();
        $choix2=array();
        $choix3=array();

        for ($i=1; $i <= $nbQuestion; $i++) { 
            array_push($intitule, $_POST['intitule'.$i]);
            array_push($image, $_POST['b64Image'.$i]);
            array_push($choix1, $_POST['reponse'.$i.'a']);
            array_push($choix2, $_POST['reponse'.$i.'b']);
            array_push($choix3, $_POST['reponse'.$i.'c']);
            $reponseQuestion=$_POST['reponseQ'.$i];
            array_push($reponseALaQuestion, $reponseQuestion);
        }
        
        if (!isset($_POST['idQCM'])) { // mode ajout
            

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
                    echo "<script>console.log(".$idQCM.")</script>";
                   
                    reset($intitule);
                    reset($image);
                    reset($reponseALaQuestion);
                    reset($choix1);
                    reset($choix2);
                    reset($choix3);
                    for ($i=1; $i <= $nbQuestion; $i++) { 
                        $statement = $pdo->prepare('INSERT INTO question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitulé, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                        $executed = $statement->execute([
                            'intitulé' => current($intitule),
                            'image' => base64_decode(current($image)),
                            'reponseALaQuestion' => current($reponseALaQuestion),
                            'choix1' => current($choix1),
                            'choix2' => current($choix2),
                            'choix3' => current($choix3),
                            'idQCM' => $idQCM
                        ]);
                        next($intitule);
                        next($image);
                        next($reponseALaQuestion);
                        next($choix1);
                        next($choix2);
                        next($choix3);
                    }
                    reset($intitule);
                    reset($image);
                    reset($reponseALaQuestion);
                    reset($choix1);
                    reset($choix2);
                    reset($choix3);

                    header("Location: ../HTML/liste_qcm.php?ajout=success");
                }
            }
        } else { // mode modification
            
        }
    }
?>