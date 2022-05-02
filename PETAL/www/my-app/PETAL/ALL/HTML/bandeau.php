<?php
    include_once('../../ALL/PHP/script_bandeau.php');

    ResumeSession();
    RedirectLogin();
?>

<div id="bandeau">
    <div id="top-bar" class="top-bar">
        <?php ShowForumButton(); ?>
        <div id="top-bar-right" onclick="Popup()">
            <span><?php echo $_SESSION['nom']; ?></span>
            <?php ShowPhotoProfil('imgBandeau', 40); ?>
        </div>
    </div>

    <div id="box">
    <div id="popup">
        <div id="logoNomPrenom">
            <a id="aImgPopup" href="<?php UrlEspacePerso(); ?>">
                <?php ShowPhotoProfil('imgPopup', 100); ?>
            </a>
            <a href="<?php UrlEspacePerso(); ?>">
                <span id="nomprenom"><?php echo $_SESSION['nom']; ?></span>
            </a>
        </div>
        <?php echo file_get_contents("../../Ressources/Icon/switch_theme.svg"); ?>
        <button onclick="Deconnexion()" id="boutonDeconnexion">Déconnexion</button>
    </div>
    </div> 
</div>

<script src="../../ALL/JS/bandeau.js"></script>
