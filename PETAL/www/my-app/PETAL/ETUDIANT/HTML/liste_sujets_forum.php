<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/liste_sujets_forum_dark.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Liste des sujet du forum</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="content">
        <div id="gauche-cours">
            <ul>
                <li>CDAA</li>
                <li>SR</li>
                <li>SI</li>
                <li>Maths</li>
                <li>BDD</li>
                <li>Modélisation</li>
            </ul>
        </div>
        <div id="droite-sujets">
            <table>
                <tr>
                    <th>Sujet</th>
                    <th>Lancé par</th>
                    <th>Nombre de réponses</th>
                    <th>Résolu</th>
                </tr>
                <tr>
                    <td>Sujet 1</td>
                    <td>NOM Prénom</td>
                    <td>3</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td>Sujet 2</td>
                    <td>NOM Prénom</td>
                    <td>7</td>
                    <td><img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td>Sujet 3</td>
                    <td>NOM Prénom</td>
                    <td>2</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td>Sujet 4</td>
                    <td>NOM Prénom</td>
                    <td>5</td>
                    <td><img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td>Sujet 5</td>
                    <td>NOM Prénom</td>
                    <td>2</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td>Sujet 6</td>
                    <td>NOM Prénom</td>
                    <td>0</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
