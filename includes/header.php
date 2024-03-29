<!-- HEADER -->

<?php
    if(isAdminConnected()){
        $adminInfos = getConnectedAdminInfos();
?>
    <div id="header-admin-infos">
        Administrateur | <?= $adminInfos["login"] ?> - 
        <a href="admin/modifier-theme.php">Modifier le thème</a> - 
        <a href="deconnexion.php">Passer en utilisateur</a>
    </div>
<?php } ?>

<div id="before-nav" class="<?= $nomPage=="index.php" ? "accueil" : "" ?>">
    <h1>
        <font id="nom-mairie"><?= "Mairie de ".($_MAIRIE["nom"] ?? ""); ?></font>
        <?php if(isAdminConnected()){ ?>
            <a onclick="modifierInfoMairie('nom', '#nom-mairie');"class="btn btn-admin-update">
                Modifier le nom
            </a>
            <a href="admin/modifier-info-mairie.php?infoType=image" class="btn btn-admin-update" style="margin-left:3px;">
				Modifier l'image
			</a>
        <?php } ?>
    </h1>
    <div id="nb-visiteurs">
        <span><?php echo $nbVisiteurs; ?></span> visiteur<?= $nbVisiteurs > 1 ? "s": ""; ?> sur cette page
    </div>
</div>
<nav id="navbar">
    <div id="navbar-content">
        <a href="index.php" class="nav-link">Accueil</a>
        <?php 
            foreach($_FONCTIONNALITES_DISPONIBLES as $index => $fonct){ 
                if(in_array($index, $_MAIRIE["fonctionnalites"])){
            ?>
            <a href="<?= $fonct["nom"] ?>.php" class="nav-link"><?= $fonct["label"] ?></a>
        <?php 
                }
            } 
        ?>
        <?php if(isAdminConnected()){ ?>
            <a href="admin/choix-fonctionnalites.php" class="pos-absolute admin-element btn btn-admin-update" style="right:15px;">
                <object data="assets/icons/edit.svg" class="icon"></object><em>Choisir les pages</em>
            </a>
        <?php } ?>
    </div>
</nav>
<script type="text/javascript">
    let splitURL = window.location.href.split("/");
    let page = splitURL[splitURL.length-1];
    let $linkEl = $('#navbar-content a[href="'+page+'"]');
    if($linkEl != null)
        $linkEl.classList.add("active");
    else
        $('#navbar-content a[href="index.php"]').classList.add("active");
</script>