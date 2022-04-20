<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../ALL/CSS/bandeau.css">
    <link rel="stylesheet" href="../CSS/edition_etudiant_dark.css">
    <link rel="icon" type="image/x-icon" href="../../Ressources/Icon/logo%20PETAL.svg">
    <meta charset="UTF-8">
    <title>Edition d'un etudiant</title>
</head>
<body>
    <?php include("../../ALL/HTML/bandeau.html");?>
    <div id="content">
        <div id="title">
            <h1 id="createAdmin">Edition d'un étudiant</h1>
        </div>
        <form>
            <table>
                <tr>
                    <td colspan="2" >
                        <input type="button" id="ajoutImageProfil" value="" onclick="AjoutImageProfil()"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nomAdmin">Nom d'utilisateur</label></br>
                        <input type="text" id="nomAdmin"/>
                    </td>
                    <td>
                        <label for="passAdmin">Mot de passe</label></br>
                        <input type="password" id="passAdmin"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mailAdmin">Adresse mail</label></br>
                        <input type="email" id="mailAdmin"/>
                    </td>
                    <td>
                        <label for="telAdmin">N°Téléphone (facultatif)</label></br>
                        <input type="tel" id="telAdmin"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="numAdmin">N°Etudiant</label></br>
                        <input type="text" id="numAdmin"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Valider" id="valider">
                    </td>
                    <td>
                        <input type="button" value="Annuler" id="annuler" onClick="window.location.href='gestion_utilisateurs.php'">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script src="../../ADMINISTRATEUR/JS/edition_etudiant.js"></script>
</body>
</html>
