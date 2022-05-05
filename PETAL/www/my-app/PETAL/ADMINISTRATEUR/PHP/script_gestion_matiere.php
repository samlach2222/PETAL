<?php
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
        $query = "SELECT nomMatiere, image from matiere";

        $count = 0;
        foreach ($pdo->query($query) as $row) {
            if($count == 0){
                echo "<tr>";
            }
            echo "<td>
                        <input class=\"input_matiere\" type=\"checkbox\" name=\"key\" value=\"value\" />
                        <a href=\"gestion_cours.php?matiere=".$row[0]."\" style=\"display:block;\" class=\"lien_matiere\">
                            <table class=\"matiere\">
                                <tr>
                                    <th>
                                        <span class=\"police\">".$row[0]."</span>                               
                                    </th>
                                </tr>
                                <tr>
                                    <td class=\"image\" style=\"background-image: url('data:image;base64,".base64_encode($row[1])."'); background-repeat: no-repeat; background-size: cover \">
                                        
                                    </td>
                                </tr>                       
                            </table>
                        </a>  
                    </td>";
            if($count == 2){
                $count = 0;
                echo "</tr>";
            }
            $count++;
        }
    }
?>