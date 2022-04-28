<?php

    //
    $numEtudiant = 2;

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

            <a href=\"matiere.php\">
                <table class=\"matiere\">
                    <tr>
                        <th>
                            <span class=\"nomCours\">".$tmp[0]."</span>
                        </th>
                    </tr>
                    <tr>
                        <td class=\"image\">
                            Image ".$nb."
                        </td>
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
?>