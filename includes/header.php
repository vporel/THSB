<!-- HEADER -->

<?php
    if(isAdminConnected()){
        $adminInfos = getConnectedAdminInfos();
?>
    <div id="header-admin-infos">
        Administrateur | <?= $adminInfos["login"] ?>
        <a href="deconnexion.php">Quitter</a>
    </div>
<?php } ?>

<div id="before-nav">
    <h1><?= "Mairie de ".$_MAIRIE["nom"]; ?></h1>
</div>
<nav id="navbar">
    <div id="navbar-toggler">+</div>
    <div id="navbar-content">
        <a href="index.php" class="nav-link active">Accueil</a>
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