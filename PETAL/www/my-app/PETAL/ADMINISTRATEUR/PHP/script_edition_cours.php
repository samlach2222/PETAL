<?php
//a verifier
    // Quand on appuie sur le bouton valider
    if(isset($_POST['valider'])) {
        EnvoiAjoutCours();
    }

    // Si l'on reviens sur la même page avec une erreur d'insertion
    if(!empty($_GET['ajout'])) {
        if($_GET['ajout'] == "error") {
            // chargement de la notification
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script src="../../ALL/JS/notify.js"></script>';
            echo '<script>AlertError("Erreur");</script>';
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
        $query = "SELECT idCours, nomCours,fichier, type de cours, nomMatiere FROM cours WHERE idCours = " . $_GET['id'];

        foreach ($pdo->query($query) as $row) { // modification des champs

            $titreCours = $row[1];
            $typeCoursSelect = $row[2];
            $b64Image = base64_encode($row[0]);
        }
    }

function AffichageEdition()
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
        $query=$pdo->prepare("SELECT idCours, nomCours, fichier, typeCours, nomMatiere FROM cours WHERE idCours = :idCours");
        $query->execute(array('idCours' => $_GET['id']));
        $rows=$query->fetchAll();
        foreach ($rows as $row) { // modification des champs
            echo "<tr>
                <td>
                    <label for=\"titreCours\">Titre du cours</label></br>
                    <input type=\"text\" name=\"titreCours\" id=\"titreCours\" value=\"".$row[1]."\" maxlength=\"50\"/>
                    <input type=\"hidden\" id=\"idCours\" name=\"idCours\" value=\"".$_GET['id']."\">
                    <input type=\"hidden\" id=\"nomMatiere\" name=\"nomMatiere\" value=\"".$row[4]."\">
                </td>
                <td rowspan=\"2\">
                    <label>Fichier</label></br>
                    <input type=\"button\" id=\"ajoutFichier\" value=\"\" onclick=\"AjoutImage()\"/>
                    <input type=\"hidden\" id=\"b64Image\" name=\"b64Image\" value=\"\">
                </td>
            </tr><tr>
                <td>
                    <label for=\"typeCours\">Type de cours</label></br>
                    <select name=\"typeCours\" id=\"typeCours\" onclick=\"typeSelect()\">
                "; 
            if ($row[3]=="CM") {
                echo "<option value=\"CM\" select=\"selected\">CM</option>";
                echo "<option value=\"TD\" >TD</option>";
                echo "<option value=\"TP\" >TP</option>";
            }   
            elseif ($row[3]=="TD") {
                echo "<option value=\"CM\" >CM</option>";
                echo "<option value=\"TD\" select=\"selected\">TD</option>";
                echo "<option value=\"TP\" >TP</option>";
            } else {
                echo "<option value=\"CM\" >CM</option>";
                echo "<option value=\"TD\" >TD</option>";
                echo "<option value=\"TP\" select=\"selected\">TP</option>";
            }
            echo "</select>
                <input type=\"hidden\" id=\"typeCoursSelect\" name=\"typeCoursSelect\" value=\"".$row[3]."\">
                </td>
            </tr>";
        }

    }
    else
    {
        // Requete de récupération de tout les utilisateurs
        $matiere=$_GET['matiere']
        echo "<tr>
                <td>
                    <label for=\"titreCours\">Titre du cours</label></br>
                    <input type=\"text\" name=\"titreCours\" id=\"titreCours\" value=\"\" maxlength=\"50\"/>
                    <input type=\"hidden\" id=\"idCours\" name=\"idCours\" value=\"-1\">
                    <input type=\"hidden\" id=\"nomMatiere\" name=\"nomMatiere\" value=\"".$matiere."\">
                </td>
                <td rowspan=\"2\">
                    <label>Fichier</label></br>
                    <input type=\"button\" id=\"ajoutFichier\" value=\"\" onclick=\"AjoutImage()\"/>
                    <input type=\"hidden\" id=\"b64Image\" name=\"b64Image\" value=\"\">
                </td>
            </tr><tr>
                <td>
                    <label for=\"typeCours\">Type de cours</label></br>
                    <select name=\"typeCours\" id=\"typeCours\" onclick=\"typeSelect()\">
                    <option value=\"CM\" select=\"selected\">CM</option>
                    <option value=\"TD\" >TD</option>
                    <option value=\"TP\" >TP</option>
                    </select>
                <input type=\"hidden\" id=\"typeCoursSelect\" name=\"typeCoursSelect\" value=\"CM\">
                </td>
            </tr>
                "; 
    }
}

    function EnvoiAjoutCours()
    {
        // Récupération des données
        $idCours = $_POST["idCours"];
        $titreCours = $_POST['titreCours'];
        $typeCours = $_POST['typeCoursSelect'];
        $fichier = $_POST['b64Image'];
        $nomMatiere = $_POST['nomMatiere'];

        if (isset($_POST['numAdmin'])) { // mode ajout
            $numAdmin = $_POST['numAdmin'];

            // vérification des données
            if ($titreCours == null || $typeCours == null || $fichier == null) {
                header("Location: ../HTML/edition_cours.php?ajout=error");
            } else {
                // Initialisation connexion BDD
                $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
                try {
                    $pdo = new PDO($dsn, "root", "root");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                // Requete d'insertion
                $statement = $pdo->prepare('INSERT INTO cours (nomCours, fichier, typeCours,nomMatiere) VALUES (:nomCours, :fichier, :typeCours,:nomMatiere)');
                $executed = $statement->execute([
                    'nomCours' => $nomCours,
                    'fichier' => base64_decode($fichier),
                    'typeCours' => $typeCours,
                    'nomMatiere' => $nomMatiere
                ]);
                if($executed){ // si la requête n'a pas pu être passée
                    // Redirection en fin de requête
                    header("Location: ../HTML/gestion_cours.php?ajout=success");
                }
                else {
                    // Redirection en fin de requête
                    header("Location: ../HTML/gestion_cours.php?ajout=error");
                }

            }
        } else { // mode modification
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $numAdmin = $_SESSION["idModif"];
            // supression de la variable de session
            unset($_SESSION["idModif"]);

            // vérification des données
            if ($nomCours == null || $fichier == null || $typeCours == null) {
                header("Location: ../HTML/gestion_cours.php?modification=error");
            } else {
                // Initialisation connexion BDD
                $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
                try {
                    $pdo = new PDO($dsn, "root", "root");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                // Requete d'insertion
                $statement = $pdo->prepare('UPDATE utilisateur SET nomCours=:nomCours, fichier=:fichier, typeCours=:typeCours,nomMatiere=:nomMatiere WHERE idCours = :idCours');
                $test = $statement->execute([
                    'nomCours' => $nomCours,
                    'fichier' => base64_decode($fichier),
                    'typeCours' => $typeCours,
                    'nomMatiere' => $nomMatiere,
                    'idCours' => $idCours
                ]);

                // Redirection en fin de requête
                header("Location: ../HTML/gestion_cours.php?modification=success");
            }
        }
    }
?>