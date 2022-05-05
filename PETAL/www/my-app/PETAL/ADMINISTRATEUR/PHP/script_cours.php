<?php
    //Variables
    $numEtudiant = $_SESSION['num'];
    $numMatiere = $_GET['matiere'];
    $nomMatiere = "";

    //connexion à la BDD
    $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";

    try {
        $pdo = new PDO($dsn, "root", "root");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $nomMatiere = $_GET['matiere'];

    echo "
        <div id=\"content\">
            <div id=\"title\">
                <h1>Cours de ".$nomMatiere."</h1>
            </div>";
                
    echo "
            <div id=\"toolbar\">
                <div id=\"conteneurBoutonRetour\">
                    <a href=\"gestion_matiere.php\" id=\"boutonRetour\">retour</a>
                </div>
                
                <a href=\"edition_cours.php\">
                    <div id=\"plus\" class=\"icon\">+</div>
                </a>
                <a href=\"edition_cours.php\">
                    <img id=\"crayon\" src=\"../../Ressources/Pictures/Crayon_Dark.png\" class=\"icon\">
                </a>
                <a href=\"\">
                    <img id=\"corbeille\" src=\"../../Ressources/Pictures/Corbeille_Dark.png\" class=\"icon\" onclick=\"myFunction()\">
                </a>
            </div>
            <div id=\"liste\">
                <table>";

    $sql = "SELECT nomCours FROM cours WHERE nomMatiere='".$nomMatiere."'";
    $donnees = $pdo->query($sql);
    while ($tmp = $donnees->fetch())
    {
        echo "
            <tr>
                <td>
                    <label>
                        <input class=\"cours\" type=\"checkbox\" name=\"key\" value=\"value\" />
                        <span>".$tmp[0]."</span>
                    </label>
                </td>
            </tr>
        ";
    }

    echo "
                </table>
            </div>
        </div>
    ";

?>