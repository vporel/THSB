<?php 
    require "./head.php";
    if(!$installation && !isAdminConnected()){
        header("Location:index.php");
        exit();
    }
    $infoType = $_GET["infoType"] ?? null;
    if($infoType == null || !in_array($infoType, ["nom", "historique", "missions", "image"])){
        echo "La requête n'a pas pu être traitée. Le type d'info n'est pas reconnu <br><a href='../index.php'>Retourner au site</a>";
        exit();
    }
    $infoValeur = $_MAIRIE[$infoType] ?? null;
    if(isset($_POST["modifier-info-mairie"])){ // etape3.php
        if($infoType == "image"){
            try{
                $infoValeur = FileUpload::upload("info-valeur", __DIR__."/../assets/images/", ["jpg", "png", "jpeg"]);
            }catch(FileUploadException $e){
                if($e->getCode() == FileUploadException::FILE_NOT_RECEIVED){               
                    $message = "Choisissez un fichier pour le champ";
                }else{               
                    $message = $e->getMessage();
                }
            }
        }else{
            $infoValeur = $_POST["info-valeur"];
        }
        $_MAIRIE[$infoType] = $infoValeur;
        file_put_contents(FICHIER_CONFIG_MAIRIE, json_encode($_MAIRIE));
        if($installation){
            $_SESSION["installation-niveau-etape-3"]++;
            header("Location:installation.php");
        }else
            header("Location:../index.php");
        exit();
    }
?>
<?php $_TITLE = "Modification ".$infoType." | THBS"; ?>
<?php $_PAGE_TITLE = "Mairie de ".$_MAIRIE["nom"] ?>
<?php ob_start(); ?>
    <style>
        label[for="info-valeur"]{text-align:center;font-size:22px!important;}
        textarea{height:350px!important;}
        .theme-image{
            max-height:200px;
        }
    </style>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="modifier-info-mairie">
        <span>
            <label for="info-valeur"><?= ucfirst($infoType) ?></label>
            <?php if($infoType == "nom"){ ?>
                <input type="text" name="info-valeur" id="info-valeur" value="<?= $infoValeur ?>"/>
            <?php }elseif($infoType == "theme"){ ?>
                <center>
                <?php for($i=1;$i<=$_NB_THEMES;$i++){ ?>
                    <input type="radio" name="info-valeur" id="theme-<?= $i ?>" value="<?= $i ?>" <?= $_MAIRIE["theme"] == $i ? "checked" : "" ?>/>
                    <label for="theme-<?= $i ?>" ><img src="../assets/images/themes/<?= $i ?>.jpg" alt="Thème <?= $i ?>" class="theme-image"></label>
                <?php } ?>
                </center>
            <?php }elseif($infoType == "image"){ ?>
                <center>
                    <input type="file" name="info-valeur" id="info-valeur" />
                    <?php
                    if($infoValeur != ""){
                        echo "<font>Actuel : $infoValeur</font>";
                    }
                    ?>
                </center>                
            <?php }else{ ?>
                <textarea name="info-valeur" id="info-valeur"><?= $infoValeur ?></textarea>
            <?php } ?>
        </span>
        <div class="btns">
            <button type="submit" class="btn btn-primary" ><?= $installation ? "Continuer" : "Terminer"?></button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean() ?>
<?php require "base.php"; ?>