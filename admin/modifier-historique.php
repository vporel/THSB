<?php 
    require "./head.php";
    if(!isAdminConnected()){
        header("Location:index.php");
        exit();
    }

    if(isset($_POST["fonctionnalites"])){ // etape3.php
        $_MAIRIE["fonctionnalites"] = $_POST["fonctionnalites"];
        file_put_contents(CONFIG_MAIRIE, json_encode($_MAIRIE));
        $message = "Choix appliqués";
    }
?>
<?php $_TITLE = "Modifier historique | THBS"; ?>
<?php $_PAGE_TITLE = "Modifier historique" ?>
<?php ob_start(); ?>

    <form method="post">
        <span>
            <textarea name="historique" value="<?= $_MAIRIE["historique"] ?? "" ?>"></textarea>
        </span>
        <div class="btns">
            <button type="submit" class="btn btn-primary">Terminer</button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean() ?>
<?php require "base.php"; ?>