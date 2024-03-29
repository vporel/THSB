<?php 
    require "./head.php";
    if(!$installation && !isAdminConnected()){
        header("Location:index.php");
        exit();
    }
    $infoType = $_GET["infoType"] ?? null;
    if($infoType == null || !in_array($infoType, ["nom", "historique", "missions", "image", "contacts"])){
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
            header("Location:../index.php#$infoType");
        exit();
    }
    
    if(in_array($infoType, ["nom", "contacts"])){ 
        $inputCode = "<input type='text' name='info-valeur' id='info-valeur' value='$infoValeur'/>";
    }elseif($infoType == "image"){
        $inputCode = "<center><input type='file' name='info-valeur' id='info-valeur' />";
        $inputCode .= ($infoValeur != "") ? "<font>Actuel : $infoValeur</font>" : "";
        $inputCode .= "</center>";         
    }else{
        $inputCode = "<textarea name='info-valeur' id='info-valeur'>$infoValeur</textarea>";
    }
    if(isset($_GET["AJAX_POST"])){
        //Doit être utilisé pour le nom, l'historique et les missions
        $_MAIRIE[$infoType] = $_POST["info-valeur"];
        file_put_contents(FICHIER_CONFIG_MAIRIE, json_encode($_MAIRIE));
        if($infoType == "nom")
            echo $_MAIRIE[$infoType] ?? "";
        else
            echo nl2br(updateText($_MAIRIE[$infoType] ?? ""));
        exit();
    }
    if(isset($_GET["GET_INPUT_CODE"])){
        echo $inputCode;
        exit();
    }
?>

<?php $_TITLE = "Modification ".$infoType." | THBS"; ?>
<?php $_PAGE_TITLE = "Mairie de ".($_MAIRIE["nom"] ?? "") ?>
<?php ob_start(); ?>
    <style>
        #modifier-info-mairie-form label[for="info-valeur"]{text-align:center;font-size:22px!important;}
        #modifier-info-mairie-form textarea{height:350px!important;}
    </style>
    <form method="post" enctype="multipart/form-data" id="modifier-info-mairie-form">
        <input type="hidden" name="modifier-info-mairie">
        <span>
            <label for="info-valeur"><?= ucfirst($infoType) ?></label>
            <?php if(in_array($infoType, ["nom", "contacts"])){ ?>
                <input type="text" name="info-valeur" id="info-valeur" value="<?= $infoValeur ?>"/>
            
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