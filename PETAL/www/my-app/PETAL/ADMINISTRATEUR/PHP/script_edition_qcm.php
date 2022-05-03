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
        //pas fini
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

    function EnvoiAjoutQCM($isPublier)
    {
        // Récupération des données
        $nomQCM = $_POST["nom"];
        $dateHeureFin = $_POST['dateHeureFin'];
        $nomMatiere = $_POST['matiere'];

        if (!isset($_POST['idQCM'])) { // mode ajout
            

            // vérification des données
            if ($nomQCM == null|| $nomMatiere==NULL|| $dateHeureFin==NULL) {
                header("Location: ../HTML/edition_qcm.php?ajout=erRor");
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
                //pas fini
                if($executed){ // si la requête n'a pas pu être passée
                    $idQCM=$pdo->lastInsertId();
                    echo "<script>console.log('idQ".$idQCM."');
                        </script>";
                    /*$dom = new DOMDocument;
                    $dom->loadHTML("../HTML/edition_qcm.php");
                    $numQuestion=1;
                    $requeteE=0;
                    do{
                        $fini=false;
                        $intitule=$dom->getElementById("intitule".$numQuestion);
                        $image=$dom->getElementById("b64Image".$numQuestion);
                        $choix1=$dom->getElementById("reponse".$numQuestion."a");
                        $choix2=$dom->getElementById("reponse".$numQuestion."b");
                        $choix3=$dom->getElementById("reponse".$numQuestion."c");
                        if (isset($_POST['reponseRB'.$numQuestion.'a'])) {
                            $reponseQuestion=0;
                        }
                        elseif (isset($_POST['reponseRB'.$numQuestion.'a'])) {
                            $reponseQuestion=1;
                        }
                        elseif (isset($_POST['reponseRB'.$numQuestion.'a'])) {
                            $reponseQuestion=2;
                        }
                        $reponseQuestion=2;
                        // Requete d'insertion
                        $statement = $pdo->prepare('INSERT INTO Question (intitulé, image, reponseALaQuestion, choix1,choix2,choix3, idQCM) VALUES (:intitule, :image, :reponseALaQuestion, :choix1, :choix2, :choix3, :idQCM)');
                        $executed = $statement->execute([
                        'intitulé' => $intitule,
                        'image' => $image,
                        'reponseALaQuestion' => $reponseQuestion,
                        'choix1' => $choix1,
                        'choix2' => $choix2,
                        'choix3' => $choix3,
                        'idQCM' => $idQCM
                        ]);
                        $numQuestion=$numQuestion+1;
                        echo "<script>console.log('idQ".$idQCM."');
                            console.log('intule".$intitule."');
                            console.log('reponse".$reponseQuestion."');
                        </script>";
                        if ($executed) {
                            $requeteE=$requeteE+1;
                        } 
                        if ($dom->getElementById("q".$numQuestion)!=NULL) {
                            $fini=true;
                        }
                    }while($fini==false);
                    if ($requeteE>=$numQuestion) {
                        // Redirection en fin de requête
                        header("Location: ../HTML/liste_qcm.php?ajout=success");
                    }
                    else{
                        // Redirection en fin de requête
                    header("Location: ../HTML/liste_qcm.php?ajout=errOr");
                    }*/
                }
                else {
                    // Redirection en fin de requête
                    header("Location: ../HTML/liste_qcm.php?ajout=erroR");
                }

            }
        } else { // mode modification
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if(isset($_POST)){
                if(isset($_POST['data'])){
                    $idQCM= json_decode($_POST['data']);
                }
            }
            $idQCM = $_POST['idQCM'];
            // vérification des données
            if ($nomQCM == null) {
                header("Location: ../HTML/liste_qcm.php?modification=error");
            } else {
                // Initialisation connexion BDD
                $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
                try {
                    $pdo = new PDO($dsn, "root", "root");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                // Requete d'insertion
                $statement = $pdo->prepare('UPDATE QCM SET nomQCM = :nomQCM, dateHeureFin = :dateHeureFin, publie = :publie, nomMatiere = :nomMatiere WHERE idQCM = :idQCM');
                $test = $statement->execute([
                    'nomQCM' => $nomQCM,
                    'dateHeureFin' => $dateHeureFin,
                    'publie' => $isPublier,
                    'nomMatiere' => $nomMatiere,
                    'idQCM' => $idQCM
                ]);
                //pas fini
                $dom = new DOMDocument;
                $dom->loadHTML("../HTML/edition_qcm.php");
                $numQuestion=1;
                do{
                    $intitule=$dom->getElementById("intitule".$numQuestion);
                    $image=$dom->getElementById("b64Image".$numQuestion);
                    $choix1=$dom->getElementById("reponse".$numQuestion."a");
                    $choix2=$dom->getElementById("reponse".$numQuestion."b");
                    $choix3=$dom->getElementById("reponse".$numQuestion."c");
                    if ($dom->getElementById("reponseRB".$numQuestion."a")->checked==true) {
                        $reponseQuestion=1;
                    }
                    elseif ($dom->getElementById("reponseRB".$numQuestion."b")->checked==true) {
                        $reponseQuestion=2;
                    }
                    elseif ($dom->getElementById("reponseRB".$numQuestion."c")->checked==true) {
                        $reponseQuestion=3;
                    }
                    // Requete d'insertion
                    $statement = $pdo->prepare('UPDATE Question SET intitulé = :intitule, image = :image, reponseALaQuestion = :reponseALaQuestion, choix1 = :choix1, choix2 = :choix2, choix3 = :choix3 WHERE idQCM = :idQCM');
                    $test=$statement->execute([
                        'intitulé' => $intitule,
                        'image' => $image,
                        'reponseALaQuestion' => $reponseQuestion,
                        'choix1' => $choix1,
                        'choix2' => $choix2,
                        'choix3' => $choix3,
                        'idQCM' => $idQCM
                    ]);
                    $numQuestion=$numQuestion+1;
                }while($dom->getElementById("q".$numQuestion)!=NULL);
                // Redirection en fin de requête
                header("Location: ../HTML/liste_qcm.php?modification=success");
            }
        }
    }
?>