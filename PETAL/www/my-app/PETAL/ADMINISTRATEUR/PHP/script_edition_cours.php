<?php
    // Initialisation connexion BDD
    include_once('../../ALL/PHP/BDD.php');

    // Quand on appuie sur le bouton valider
    if(isset($_POST['valider'])) {
        EnvoiAjoutCours();
    }

    // Si l'on reviens sur la même page avec une erreur d'insertion
    if(!empty($_GET['ajout'])) {
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script src="../../ALL/JS/notify.js"></script>';
        
        switch($_GET['ajout']) {
            case 'errorFile':
                echo '<script>AlertError("Erreur : Il manque le fichier du cours");</script>';
                break;
            case 'error':
            default:
                echo '<script>AlertError("Erreur");</script>';
                break;
        }
    }

    function RedirectGestion() {
        //Vérification de la matière
        if (!empty($_GET['matiere'])) {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            global $pdo;

            $prepared = $pdo->prepare("SELECT nomMatiere FROM matiere WHERE num = :num && nomMatiere = :nomMatiere");
            $prepared->execute(array('num' => $_SESSION['num'], 'nomMatiere' => $_GET['matiere']));
            $rows = $prepared->fetchAll();

            // Vérifie que la matière existe et que l'utilisateur connecté la gère
            if (count($rows) == 0) {
                header("Location: gestion_matiere.php");
                exit;
            }

        } else {
            header("Location: gestion_matiere.php");
        }

        //Vérification de l'id
        if(!empty($_GET['id'])) {
            // Récupère le cours depuis l'id et la matière
            $prepared = $pdo->prepare("SELECT idCours FROM cours WHERE idCours = :idCours && nomMatiere = :nomMatiere");
            $prepared->execute(array('idCours' => $_GET['id'], 'nomMatiere' => $_GET['matiere']));
            $rows = $prepared->fetchAll();

            // Vérifie que le cours avec cet id et matière existe
            if (count($rows) == 0) {
                header("Location: gestion_cours.php?matiere=".$_GET['matiere']);
                exit;
            }
        }
    }

    function AffichageEdition()
    {
        if(!empty($_GET['id'])) {

            global $pdo;

            // Requete de récupération du cours
            $query = $pdo->prepare("SELECT nomCours, fichier, typeCours FROM cours WHERE idCours = :idCours");
            $query->execute(array('idCours' => $_GET['id']));
            $rows = $query->fetchAll();
            foreach ($rows as $row) { // modification des champs
                $urlFichier = str_replace(' ', '%20', 'http://localhost'.$row[1]);  //Il faut remplacer les espaces par %20 pour get_headers
                $fileSize = get_headers($urlFichier,true)['Content-Length'];
                
                $trimmedSize = ConvertirFileSize($fileSize);
                
                echo "<tr>
                    <td>
                        <label for=\"titreCours\">Titre du cours</label></br>
                        <input type=\"text\" name=\"titreCours\" id=\"titreCours\" value=\"".$row[0]."\" maxlength=\"50\" required/>
                        <input type=\"hidden\" id=\"nomMatiere\" name=\"nomMatiere\" value=\"".$_GET['matiere']."\">
                    </td>
                    <td rowspan=\"2\" id=\"td-fichier\">
                        <label>Fichier</label></br>
                        <input type=\"button\" id=\"ajoutFichier\" style=\"background-size: 0%;\" value=\"".basename($row[1]).PHP_EOL.PHP_EOL.$trimmedSize."\" onclick=\"AjoutImage()\"/>
                    </td>
                </tr><tr>
                    <td>
                        <label for=\"typeCours\">Type de cours</label></br>
                        <select name=\"typeCours\" id=\"typeCours\" required>";
                switch ($row[2]) {
                    case "CM":
                        echo "<option value=\"CM\" selected>CM</option>";
                        echo "<option value=\"TD\" >TD</option>";
                        echo "<option value=\"TP\" >TP</option>";
                        break;
                    case "TD":
                        echo "<option value=\"CM\" >CM</option>";
                        echo "<option value=\"TD\" selected>TD</option>";
                        echo "<option value=\"TP\" >TP</option>";
                        break;
                    default:
                        echo "<option value=\"CM\" >CM</option>";
                        echo "<option value=\"TD\" >TD</option>";
                        echo "<option value=\"TP\" selected>TP</option>";
                        break;
                }

                    echo "</select>
                    </td>
                </tr>";
            }
        }
        else
        {
            // Création d'un nouveau cours : pas de pré-remplissage
            echo "<tr>
                    <td>
                        <label for=\"titreCours\">Titre du cours</label></br>
                        <input type=\"text\" name=\"titreCours\" id=\"titreCours\" value=\"\" maxlength=\"50\" required/>
                        <input type=\"hidden\" id=\"nomMatiere\" name=\"nomMatiere\" value=\"".$_GET['matiere']."\">
                    </td>
                    <td rowspan=\"2\" id=\"td-fichier\">
                        <label>Fichier</label></br>
                        <input type=\"button\" id=\"ajoutFichier\" value=\"\" onclick=\"AjoutImage()\"/>
                    </td>
                </tr><tr>
                    <td>
                        <label for=\"typeCours\">Type de cours</label></br>
                        <select name=\"typeCours\" id=\"typeCours\" required>
                        <option value=\"CM\" select=\"selected\">CM</option>
                        <option value=\"TD\" >TD</option>
                        <option value=\"TP\" >TP</option>
                        </select>
                    </td>
                </tr>"; 
        }
    }

    function EnvoiAjoutCours()
    {
        // Récupération des données
        $titreCours = $_POST['titreCours'];
        $typeCours = $_POST['typeCours'];
        $nomMatiere = $_GET['matiere'];

        if (empty($_GET['id'])) { // mode ajout
            // vérification des données
            if ($titreCours == null || $typeCours == null || empty($_FILES['fichier'])) {
                if (empty($_FILES['fichier'])) {
                    header("Location: ?matiere=".$_GET['matiere']."&ajout=errorFile");
                } else {
                    header("Location: ?matiere=".$_GET['matiere']."&ajout=error");
                }
            } else {
                // Initialisation connexion BDD
                global $pdo;
                
                $fichierChemin = UploaderFichier();
                
                // Requete d'insertion
                $statement = $pdo->prepare('INSERT INTO cours (nomCours, fichier, typeCours,nomMatiere) VALUES (:nomCours, :fichier, :typeCours,:nomMatiere)');
                $executed = $statement->execute([
                    'nomCours' => $titreCours,
                    'fichier' => $fichierChemin,
                    'typeCours' => $typeCours,
                    'nomMatiere' => $nomMatiere
                ]);
                if($executed){ // si la requête n'a pas pu être passée
                    // Redirection en fin de requête
                    header("Location: gestion_cours.php?matiere=".$_GET['matiere']."&ajout=success");
                }
                else {
                    // Redirection en fin de requête
                    header("Location: gestion_cours.php?matiere=".$_GET['matiere']."&ajout=error");
                }

            }
        } else { // mode modification
            // vérification des données
            if ($titreCours == null || $typeCours == null) {
                header("Location: ?id=".$_GET['id']."&matiere=".$_GET['matiere']."&ajout=error");
            } else {
                // Initialisation connexion BDD
                global $pdo;
                
                //Upload le fichier seulement si un nouveau fichier a été selectionné
                if (!empty($_FILES['fichier'])) {
                    $fichierChemin = UploaderFichier(true);
                    
                    // Requete d'update
                    $statement = $pdo->prepare('UPDATE cours SET nomCours=:nomCours, fichier=:fichier, typeCours=:typeCours WHERE idCours = :idCours');
                    $statement->execute([
                        'nomCours' => $titreCours,
                        'fichier' => $fichierChemin,
                        'typeCours' => $typeCours,
                        'idCours' => $_GET['id']
                    ]);
                } else {
                    // Requete d'update
                    $statement = $pdo->prepare('UPDATE cours SET nomCours=:nomCours, typeCours=:typeCours WHERE idCours = :idCours');
                    $statement->execute([
                        'nomCours' => $titreCours,
                        'typeCours' => $typeCours,
                        'idCours' => $_GET['id']
                    ]);
                }

                // Redirection en fin de requête
                header("Location: gestion_cours.php?matiere=".$_GET['matiere']."&modification=success");
            }
        }
    }

    function UploaderFichier($deletePreviousFile = false) {
        $asciiFileName = iconv('UTF-8', 'ASCII//IGNORE', basename($_FILES['fichier']['name']));  //Garde uniquement les caractères ASCII
        $chemin = '/my-app/PETAL/Cours/'.$_GET['matiere'].'/'.$asciiFileName; 
        $cheminReel = realpath($_SERVER["DOCUMENT_ROOT"]).$chemin;  //Utilise le chemin où se trouve la partie web de PETAL
        
        //Crée la structure de dossier nécessaire
        if (!file_exists(dirname($cheminReel))) {
            mkdir(dirname($cheminReel),0777,true);
        }
        
        //Supprime l'ancien fichier
        if ($deletePreviousFile) {
            global $pdo;
            $prepared = $pdo->prepare("SELECT fichier FROM cours WHERE idCours = :idCours");
            $prepared->execute(array('idCours' => $_GET['id']));
            $rows = $prepared->fetchAll();
            
            $ancienChemin = realpath($_SERVER["DOCUMENT_ROOT"]).$rows[0][0];
            if (file_exists($ancienChemin)) {
                unlink($ancienChemin);
            }
        }

        move_uploaded_file($_FILES['fichier']['tmp_name'], $cheminReel);

        return $chemin;
    }

    function ConvertirFileSize($fileSize) {
        $sizeType = 0;
        $trimmedSize = $fileSize;
        while ($trimmedSize > 1024 && $sizeType < 4) {
            $trimmedSize /= 1024;
            $sizeType++;
        }

        //Arrondi à 2 chiffres après la virgule
        $result = round($trimmedSize, 2);

        //Ajoute l'unité de taille
        switch ($sizeType) {
            case 0:
                $result .= ' o';
                break;
            case 1:
                $result .= ' Ko';
                break;
            case 2:
                $result .= ' Mo';
                break;
            case 3:
                $result .= ' Go';
                break;
            case 4:
                $result .= ' To';
                break;
        }

        //Remplace le séparateur décimal par une virgule
        $result = str_replace('.', ',', $result);

        return $result;
    }
?>