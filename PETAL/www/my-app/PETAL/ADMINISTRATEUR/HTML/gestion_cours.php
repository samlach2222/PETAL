<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if($_COOKIE['theme'] == 0) { //light
            echo '<link rel="stylesheet" href="../CSS/gestion_cours_light.css">';
        }
        else { //dark
            echo '<link rel="stylesheet" href="../CSS/gestion_cours_dark.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Gestion d'un cours</title>
</head>

<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="content">
        <div id="title">
            <h1>Cours de < MATIERE > </h1>
        </div>
        <div id="toolbar">
            <div id="conteneurBoutonRetour">
                <a href="gestion_matiere.php" id="boutonRetour">retour</a>
            </div>
            
            <a href="edition_cours.php">
                <div id="plus" class="icon">+</div>
            </a>
            <a href="edition_cours.php">
                <img id="crayon" src="../../Ressources/Pictures/Crayon_Dark.png" class="icon">
            </a>
            <a href="">
                <img id="corbeille" src="../../Ressources/Pictures/Corbeille_Dark.png" class="icon" onclick="myFunction()">
            </a>
        </div>
        <div id="liste">
            <table>
                <tr>
                    <td>
                        <label>
                            <input class="cours" type="checkbox" name="key" value="value" />
                            <span>Cours1.pdf</span>
                        </label>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input class="cours" type="checkbox" name="key" value="value" />
                            <span>Cours2.zip</span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input class="cours" type="checkbox" name="key" value="value" />
                            <span>CM3.pptx</span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input class="cours" type="checkbox" name="key" value="value" />
                            <span>CM6.xlsx</span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input class="cours" type="checkbox" name="key" value="value" />
                            <span >...</span>
                        </label>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script src="../../ADMINISTRATEUR/JS/gestion_cours.js"></script>
</body>
</html>
