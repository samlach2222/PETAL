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
                <li id="retour-cours"><a id="a-retour-cours" href="matiere.php?matiere=CDAA">&lt;- Cours de CDAA</a></li> <!-- Doit changer en fonction de la matière actuellement choisie -->
                <li><a href="?matiere=CDAA">CDAA</a></li>
                <li><a href="?matiere=SR">SR</a></li>
                <li><a href="?matiere=SI">SI</a></li>
                <li><a href="?matiere=MATHS">Maths</a></li>
                <li><a href="?matiere=BDD">BDD</a></li>
                <li><a href="?matiere=MODELISATION">Modélisation</a></li>
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
                    <td><a href="discussion_forum.php?sujet=Sujet 1">Sujet 1</a></td>
                    <td>NOM Prénom</td>
                    <td>3</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td><a href="discussion_forum.php?sujet=Sujet 2">Sujet 2</a></td>
                    <td>NOM Prénom</td>
                    <td>7</td>
                    <td><img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td><a href="discussion_forum.php?sujet=Sujet 3">Sujet 3</a></td>
                    <td>NOM Prénom</td>
                    <td>2</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td><a href="discussion_forum.php?sujet=Sujet 4">Sujet 4</a></td>
                    <td>NOM Prénom</td>
                    <td>5</td>
                    <td><img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td><a href="discussion_forum.php?sujet=Sujet 5">Sujet 5</a></td>
                    <td>NOM Prénom</td>
                    <td>2</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
                <tr>
                    <td><a href="discussion_forum.php?sujet=Sujet 6">Sujet 6</a></td>
                    <td>NOM Prénom</td>
                    <td>0</td>
                    <td><img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
