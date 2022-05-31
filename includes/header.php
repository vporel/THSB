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

<div id="before-nav">
    <h1>
        <?= "Mairie de ".$_MAIRIE["nom"]; ?>
        <?php if(isAdminConnected()){ ?>
            <a href="admin/modifier-info-mairie.php?infoType=nom" class="admin-element btn btn-admin-update" style="right:5px;">
                Modifier
            </a>
        <?php } ?>
    </h1>
</div>
<nav id="navbar">
    <div id="navbar-toggler">+</div>
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
            <a href="admin/choix-fonctionnalites.php" class="pos-absolute admin-element btn btn-admin-update" style="right:5px;">
                Modifier
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