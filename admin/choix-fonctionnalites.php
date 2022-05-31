<?php 
    require "./head.php";
    if(!isAdminConnected()){
        header("Location:index.php");
        exit();
    }

    if(isset($_POST["fonctionnalites"])){ // etape3.php
        $_MAIRIE["fonctionnalites"] = $_POST["fonctionnalites"];
        file_put_contents(CONFIG_MAIRIE, json_encode($_MAIRIE));
        header("Location:../index.php");
        exit();
    }
?>
<?php $_TITLE = "Choix fonctionnalités | THBS"; ?>
<?php $_PAGE_TITLE = "Choix des fonctionnalités" ?>
<?php ob_start(); ?>
<style>
    label{display:inline!important}
</style>
    <form method="post">
        <?php foreach($_FONCTIONNALITES_DISPONIBLES as $index => $fonc){ ?>
        <span>
            <input type="checkbox" name="fonctionnalites[]" id="<?= $fonc["nom"] ?>" value="<?= $index ?>" <?= in_array($index, $_MAIRIE["fonctionnalites"]) ? "checked" : "" ?>/>
            <label for="<?= $fonc["nom"] ?>"><?= $fonc["label"] ?></label>
        </span>
        <?php } ?>
        <div class="btns">
            <button type="submit" class="btn btn-primary">Terminer</button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean() ?>
<?php require "base.php"; ?>