<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/discussion_forum_dark.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo PETAL.svg">
    <meta charset="UTF-8">
    <title>Discussions du forum</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="content">
        <div id="gauche-cours">
            <ul>
                <li id="retour-cours"><a id="a-retour-cours" href="matiere.php?matiere=CDAA">Cours de CDAA</a></li>
                <li><a href="liste_sujets_forum.php?matiere=CDAA">CDAA</a></li>
                <li><a href="liste_sujets_forum.php?matiere=SR">SR</a></li>
                <li><a href="liste_sujets_forum.php?matiere=SI">SI</a></li>
                <li><a href="liste_sujets_forum.php?matiere=MATHS">Maths</a></li>
                <li><a href="liste_sujets_forum.php?matiere=BDD">BDD</a></li>
                <li><a href="liste_sujets_forum.php?matiere=MODELISATION">Modélisation</a></li>
            </ul>
        </div>
        <div id="droite-sujet">
            <div id="bandeau-sujet">
                <div class="retour-liste">
                    <a id="a-retour-liste" href="liste_sujets_forum.php?matiere=CDAA">Sujets de CDAA</a> <!-- Doit changer en fonction de la matiere du sujet -->
                </div>
                <div id="bandeau-sujet-nom-div">
                    <span id="bandeau-sujet-nom-span">Sujet 1</span>
                </div>
                <div id="bandeau-sujet-resolu">
                    <span>Résolu : </span>
                    <img src="../../Ressources/Pictures/résolu.png" width="40px" height="40px"/>
                    <span> / </span>
                    <img src="../../Ressources/Pictures/non_résolu.png" width="40px" height="40px"/>
                </div>
            </div>
            <div id="messages">
                <div class="message-recu">
                    <div class="message-entete">
                        <span class="message-nom">NOM Prénom</span>
                        <span class="message-date">Date</span>
                    </div>
                    <div class="message-contenu">
                        message
                    </div>
                </div>
                <div class="message-recu">
                    <div class="message-entete">
                        <span class="message-nom">NOM Prénom</span>
                        <span class="message-date">Date</span>
                    </div>
                    <div class="message-contenu">
                        message
                    </div>
                </div>
                <div class="message-envoye">
                    <div class="message-entete">
                        <span class="message-nom">NOM Prénom</span>
                        <span class="message-date">Date</span>
                    </div>
                    <div class="message-contenu">
                        message
                    </div>
                </div>
            </div>
            <div id="envoyer-message">
                <span id="envoyer-message-span">Poster un message :</span>
                <textarea id="envoyer-message-texte"></textarea>
                <button id="envoyer-message-bouton" onclick="EnvoyerMessage()">Envoyer</button>
            </div>
        </div>
    </div>
</body>
</html>
