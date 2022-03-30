<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/gestion_matiere.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Gestion des matières</title>
</head>

<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="content">
        <div id="title">
            <h1>Gestion des matières</h1>
        </div>

        <div id="toolbar">
            <div id="conteneurBoutonRetour">
                <a href="accueil_admin.php" id="boutonRetour">retour</a>
            </div>
            <a href="edition_matiere.php">
                <span id="plus" >+</span>
            </a>
            <a href="">
                <img id="corbeille" src="../../Ressources/Pictures/Corbeille_Dark.png" class="icon">
            </a>
        </div>

        <div>
        <table id="allMatiere">
                <tr>
                    <td>
                        <table class="matiere">
                            <tr>
                                <th>
                                    <span class="police">NOM MATIERE</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                   <span class="police">Image</span> 
                                </td>
                            </tr>
                            
                        </table>

                    </td>
                    <td>

                        <table class="matiere">
                            <tr>
                                <th>
                                    <span class="police">NOM MATIERE</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                <span class="police">Image</span> 
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td>

                        <table class="matiere">
                            <tr>
                                <th>
                                    <span class="police">NOM MATIERE</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                <span class="police">Image</span> 
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <tr>
                    <td>

                        <table class="matiere">
                            <tr>
                                <th>
                                    <span class="police">NOM MATIERE</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                <span class="police">Image</span> 
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td>

                        <table class="matiere">
                            <tr>
                                <th>
                                    <span class="police">NOM MATIERE</span>
                                </th>
                            </tr>
                            <tr>
                                <td class="image">
                                <span class="police">Image</span> 
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td>

                        <table class="matiere">
                            <tr>
                                <th>
                                    <span class="police">NOM MATIERE</span>
                                </th>
                            </tr>
                            <tr>
                                <td  class="image">
                                <span class="police">Image</span> 
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

            </table>
        </div>
    </div>
</body>
</html>
