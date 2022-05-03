<?php

    //Variables
    $numEtudiant = $_SESSION['num'];

    //connexion à la BDD
    $dsn = "mysql:host=localhost;dbname=petal_db;charset=UTF8";

    try {
        $pdo = new PDO($dsn, "root", "root");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //Requête
    $sql = "SELECT nomMatiere FROM etumatiere WHERE num=".strval($numEtudiant);
    $donnees = $pdo->query($sql);

    $nb=0;
    while ($tmp = $donnees->fetch()){
        if(($nb%3) == 0)
        { 
            echo "<tr>";
        }
        echo "
        <td class=\"espace\">

            <a href=\"matiere.php?matiere=".strval($nb)."\">
                <table class=\"matiere\">
                    <tr>
                        <th>
                            <span class=\"nomCours\">".$tmp[0]."</span>
                        </th>
                    </tr>
                    <tr>
                        <td class=\"image\">";
                            $sql2 = "SELECT image FROM matiere WHERE nomMatiere=\"".$tmp[0]."\"";
                            $donnees2 = $pdo->query($sql2);
                            while ($tmp2 = $donnees2->fetch()){
                                if(!is_null($tmp2[0])){
                                    echo "<div class=\"container\" style=\"background-image:url('".$tmp2[0]."');\"></div>";
                                }   
                            }
                            
                            echo
                        "</td>
                    </tr>
                </table>
            </a>

        </td>
        ";
        if(($nb%3) == 2)
        { 
            echo "</tr>";
        }
        $nb++;
    }

    

    //echo "<img src=\"/my-app/PETAL/Cours/Matiere 1/bdd.png\"/>";
?>