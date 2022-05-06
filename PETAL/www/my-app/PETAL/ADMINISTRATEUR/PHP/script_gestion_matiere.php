<?php
// Permet de supprimer par ID les utilisateurs
if(isset($_POST)){
    if(isset($_POST['data'])){
        $nameList = json_decode($_POST['data']);
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // DELETE
        $query = "DELETE FROM matiere WHERE nomMatiere IN ( ";
        foreach($nameList as $name){
            if($name == end($nameList)) {
                $query .= "'".$name."')";
            }
            else {
                $query .= "'".$name."', ";
            }
        }
        $pdo->exec($query);
    }
}

    // Permet d'afficher la liste des utilisateurs dans la page HTML
    function AfficheListeMatieres() {
        // Initialisation connexion BDD
        $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";
        try {
            $pdo = new PDO($dsn, "root", "root");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Requete de récupération de tout les utilisateurs
        $query = "SELECT nomMatiere, image from matiere WHERE num = :num";
        $prepared = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepared->execute(array('num' => $_SESSION['num']));
        $rows = $prepared->fetchAll();
        
        foreach ($rows as $row) {
            echo "<a href=\"gestion_cours.php?matiere=".$row[0]."\" style=\"display:block;\" class=\"lien_matiere\">
            <table class=\"matiere\">
                <tr>
                    <th>
                        <input class=\"input_matiere\" type=\"checkbox\" name=\"key\" value=\"value\" />
                        <span class=\"police\">".$row[0]."</span>
                        <a href=\"ajout_etudiant_matiere.php?matiere=".$row[0]."\"><img class=\"img-ajout-etudiant-matiere\" src=\"../../Ressources/Pictures/utilisateur.png\"></a>
                    </th>
                </tr>
                <tr class=\"tr-image\">
                    <td class=\"td-image\" style=\"background-image: url('data:image;base64,".base64_encode($row[1])."'); background-repeat: no-repeat; background-size: cover \">
                    </td>
                </tr>                       
            </table>
            </a>";
        }
    }
?>