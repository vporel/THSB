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
        <a href="index.html" class="active">Accueil</a>
        <a href="">Projets</a>
        <a href="">Activites</a>
        <a href="">Annonces</a>
        <a href="">Lieux touristiques</a>
        <a href="">Espace PUB</a>
    </div>
</nav>