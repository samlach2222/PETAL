<?php
 // Quand on appuie sur le bouton valider
    if(isset($_POST['valider'])) {
        EnvoiAjoutQCM();
    }
    if(isset($_POST['publier'])) {
        EnvoiAjoutQCMPublier();
    }
    if(isset($_POST)) {
        // Reception de l'ID de modification
        if (isset($_POST['data'])) {
            $idQcm = json_decode($_POST['data']);

            // Initialisation connexion BDD
            $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
            try {
                $pdo = new PDO($dsn, "root", "root");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }

            // Requete de récupération de tout les utilisateurs
            $query = "SELECT idQCM, nomQCM, dateHeureFin, nomMatiere FROM QCM WHERE idQCM = " . $idQcm;

            $dom = new DOMDocument;
            $dom->loadHTML("../HTML/edition_qcm.php");
            foreach ($pdo->query($query) as $row) { // modification des champs
                $dom->getElementById("nom")->value = $row[1];
                $dom->getElementById("matiere")->value = $row[3];
                $dom->getElementById("dateHeureFin")->value = $row[2];
            }
            $query = "SELECT idQCM, idQuestion, intitulé, image, reponseALaQuestion, choix1, choix2, choix3 FROM Question WHERE idQCM = " . $idQcm;

            foreach ($pdo->query($query) as $row) {
                if ($row[3]==null) {
                    echo "
                    <div class=\"question\">
                        <label>Question </label>
                        <output id=\"out".$row[1]."\">".$row[1]."</output>
                        <label> : </label>
                        <input type=\"text\" name=\"question\" value=\"".ucfirst(strtolower($row[2]))."\" id=\"intitule".$row[1]."\">
                        <button onclick=\"AjoutImageQCM()\" class=\"BtAjoutImage\" id=\"bt".$row[1]."\">Ajout image</button>
                        <input type=\"hidden\" id=\"b64Image".$row[1]."\" name=\"b64Image\" value=\"\"><br>
                        <div id=\"reponses".$row[1]."\">
                            <input type=\"radio\" name=\"reponse\" id=\"reponseRB".$row[1]."a\">
                                <input type=\"text\" name=\"reponse\"value=\"".ucfirst(strtolower($row[5]))."\" id=\"reponse".$row[1]."a\"><br>
                            <input type=\"radio\" name=\"reponse\" id=\"reponseRB".$row[1]."b\">
                                <input type=\"text\" name=\"reponse\"value=\"".ucfirst(strtolower($row[6]))."\" id=\"reponse".$row[1]."b\"><br>
                            <input type=\"radio\" name=\"reponse\" id=\"reponseRB".$row[1]."c\">
                                <input type=\"text\" name=\"reponse\"value=\"".ucfirst(strtolower($row[7]))."\" id=\"reponse".$row[1]."c\"><br>
                        </div>
                    </div>";
                }
                else{
                    echo "
                    <div class=\"question\">
                        <label>Question </label>
                        <output id=\"out".$row[1]."\">".$row[1]."</output>
                        <label> : </label>
                        <input type=\"text\" name=\"question\" value=\"".ucfirst(strtolower($row[2]))."\" id=\"intitule".$row[1]."\">
                        <button onclick=\"AjoutImageQCM()\" class=\"BtAjoutImage\" id=\"bt".$row[1]."\">Ajout image</button>
                        <input id=\"b64Image".$row[1]."\" name=\"b64Image\" value=\"\"><br>
                        <div id=\"reponses".$row[1]."\">
                            <input type=\"radio\" name=\"reponse\" id=\"reponseRB".$row[1]."a\">
                                <input type=\"text\" name=\"reponse\"value=\"".ucfirst(strtolower($row[5]))."\" id=\"reponse".$row[1]."a\"><br>
                            <input type=\"radio\" name=\"reponse\" id=\"reponseRB".$row[1]."b\">
                                <input type=\"text\" name=\"reponse\"value=\"".ucfirst(strtolower($row[6]))."\" id=\"reponse".$row[1]."b\"><br>
                            <input type=\"radio\" name=\"reponse\" id=\"reponseRB".$row[1]."c\">
                                <input type=\"text\" name=\"reponse\"value=\"".ucfirst(strtolower($row[7]))."\" id=\"reponse".$row[1]."c\"><br>
                        </div>
                    </div>";
                    $img = imagecreatefromstring(base64_decode($row[3]));
                    $dom->getElementById("b64Image".$row[1])->value = $row[3];
                    $dom->getElementById("b64Image".$row[1])->background_image = $img;
                }
                if ($row[4]==1) {
                    $dom->getElementById("reponseRB".$row[1]."a")->checked = true;
                }
                elseif ($row[4]==2) {
                    $dom->getElementById("reponseRB".$row[1]."b")->checked = true;
                }
                elseif ($row[4]==3) {
                    $dom->getElementById("reponseRB".$row[1]."c")->checked = true;
                }
            }
        }
    }

    // Si l'on reviens sur la même page avec une erreur d'insertion
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "error") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Identifiants incorrects");</script>';
        }
    }

 
    function EnvoiAjoutQCM()
    {

        // Récupération des données
        $nom = $_POST["nom"];
        $matiere = $_POST['matiere'];
        $dateFin = $_POST['dateHeureFin'];
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        // Requete d'insertion
        $statement = $pdo->prepare('INSERT INTO QCM (nomQCM, dateHeureFin, publie, nomMatiere) VALUES (:nom, :dateFin, :publie, :nomMatiere)');
        $statement->execute([
            'nom' => $nom,
            'dateFin' => $dateFin,
            'publie' => 0,
            'nomMatiere' => $matiere
        ]);
        $dom = new DOMDocument;
        $dom->loadHTML("../HTML/edition_qcm.php");
        $questions=$dom->getElementsByClassName("question");
        $nbquestions=count($questions);
        for ($i=1; $i <=$nbquestions; $i++) { 
            $intitule=$dom->getElementById("intitule".$i);
            $idquestion=$i;
            $image=$dom->getElementById("b64Image".$i);
            $choix1=$dom->getElementById("reponse".$i."a");
            $choix2=$dom->getElementById("reponse".$i."b");
            $choix3=$dom->getElementById("reponse".$i."c");
            if ($dom->getElementById("reponseRB".$i."a")->checked==true) {
                $reponseQuestion=1;
            }
            elseif ($dom->getElementById("reponseRB".$i."b")->checked==true) {
                $reponseQuestion=2;
            }
            elseif ($dom->getElementById("reponseRB".$i."c")->checked==true) {
                $reponseQuestion=3;
            }
            // Requete d'insertion
            $statement = $pdo->prepare('INSERT INTO Question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitule, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
            $statement->execute([
            'intitule' => $intitule,
            'image' => $image,
            'reponseALaQuestion' => $reponseQuestion,
            'choix1' => $choix1,
            'choix2' => $choix2,
            'choix3' => $choix3
            ]);
        }
        // Redirection en fin de requête
        header("Location: ../HTML/liste_qcm.php?ajout=success");
    }
    function EnvoiAjoutQCMPublier()
    {

        // Récupération des données
        $nom = $_POST["nom"];
        $matiere = $_POST['matiere'];
        $dateFin = $_POST['dateHeureFin'];
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        // Requete d'insertion
        $statement = $pdo->prepare('INSERT INTO QCM (nomQCM, dateHeureFin, publie, nomMatiere) VALUES (:nom, :dateFin, :publie, :nomMatiere)');
        $statement->execute([
            'nom' => $nom,
            'dateFin' => $dateFin,
            'publie' => 1,
            'nomMatiere' => $matiere
        ]);
        $dom = new DOMDocument;
        $dom->loadHTML("../HTML/edition_qcm.php");
        $questions=$dom->getElementsByClassName("question");
        $nbquestions=count($questions);
        for ($i=1; $i <=$nbquestions; $i++) { 
            $intitule=$dom->getElementById("intitule".$i);
            $idquestion=$i;
            $image=$dom->getElementById("b64Image".$i);
            $choix1=$dom->getElementById("reponse".$i."a");
            $choix2=$dom->getElementById("reponse".$i."b");
            $choix3=$dom->getElementById("reponse".$i."c");
            if ($dom->getElementById("reponseRB".$i."a")->checked==true) {
                $reponseQuestion=1;
            }
            elseif ($dom->getElementById("reponseRB".$i."b")->checked==true) {
                $reponseQuestion=2;
            }
            elseif ($dom->getElementById("reponseRB".$i."c")->checked==true) {
                $reponseQuestion=3;
            }
            // Requete d'insertion
            $statement = $pdo->prepare('INSERT INTO Question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitule, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
            $statement->execute([
            'intitule' => $intitule,
            'image' => $image,
            'reponseALaQuestion' => $reponseQuestion,
            'choix1' => $choix1,
            'choix2' => $choix2,
            'choix3' => $choix3
            ]);
        }
        
        // Redirection en fin de requête
        header("Location: ../HTML/liste_qcm.php?ajout=success");
    }
?>
