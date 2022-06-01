<?php 
    require "./head.php";
    if(!isAdminConnected()){
        header("Location:index.php");
        exit();
    }
    if(isset($_POST["couleur-site"])){
        $_THEME["couleur-site"] = $_POST["couleur-site"];
        $_THEME["couleur-admin"] = $_POST["couleur-admin"];
        $_THEME["numero"] = $_POST["numero-theme"];
        file_put_contents(FICHIER_CONFIG_THEME, json_encode($_THEME));
        header("Location:../index.php");
        exit();
    }
    $numeroTheme = $_THEME["numero"] ?? $_THEME_DEFAUT["numero"];
    $dispos = $_THEME["dispositions"] ?? $_THEME_DEFAUT["dispositions"];
?>
<?php $_TITLE = "Modification du theme | THBS"; ?>
<?php $_PAGE_TITLE = "Modification du theme"; ?>
<?php ob_start(); ?>
    <style>
        .theme-image{
            max-height:200px;
        }
        .dispo-span *{
            display: inline-block;
        }
    </style>
    <form method="post">
        <span>
            <label for="couleur-site">Couleur du site</label>
            <input type="color" value="<?= $_THEME["couleur-site"] ?? $_THEME_DEFAUT["couleur-site"] ?>" name="couleur-site"id="couleur-site"/>
            
        </span>
        <span>
            <label for="couleur-admin">Couleur de l'administration</label>
            <input type="color" value="<?= $_THEME["couleur-admin"] ?? $_THEME_DEFAUT["couleur-admin"] ?>" name="couleur-admin"id="couleur-admin"/>
            
        </span>
        <span>
            <label>Template</label>
            <center>
            <?php for($i=1;$i<=$_NB_THEMES;$i++){ ?>
                <input type="radio" name="numero-theme" id="theme-<?= $i ?>" value="<?= $i ?>" <?= $numeroTheme == $i ? "checked" : "" ?>/>
                <label for="theme-<?= $i ?>" ><img src="../assets/images/themes/<?= $i ?>.jpg" alt="Thème <?= $i ?>" class="theme-image"></label>
            <?php } ?>
            </center>
        </span>
        <details>
            <summary style="cursor:pointer">Disposition des elements</summary>
            <?php 
                foreach($_FONCTIONNALITES_DISPONIBLES as $index => $fonc){ 
                    $nbDispositions = ($index == 1) ? 2 : 4;
                ?>
                <fieldset>
                    <legend><?= $fonc["label"] ?></legend>
                    <center class="dispo-span">
                    <?php for($i=1;$i<=$nbDispositions;$i++){ ?>
                        <input type="radio" name="disposition-<?= $index ?>" id="dispo-<?= $index ?>-<?= $i ?>" value="<?= $i ?>" <?= $dispos[$index] == $i ? "checked" : "" ?>/>
                        <label for="dispo-<?= $index ?>-<?= $i ?>" ><img src="../assets/images/dispositions/<?= $i ?>.jpg" alt="Disposition <?= $i ?>" class="theme-image"></label>
                    <?php } ?>
                </center>
                </fieldset>
            <?php } ?>
        </details>
        <div class="btns">
            <button type="submit" class="btn btn-primary" >Terminer</button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean() ?>
<?php require "base.php"; ?>