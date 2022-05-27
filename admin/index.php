<?php 
    require "./head.php";
    if(isAdminConnected()){
        header("Location:../index.php");
        exit();
    }
    if(isset($_POST["connexion-administrateur"])){
        $login = $_POST["login"];
        $motDePasse = $_POST["mot-de-passe"];
        $admin = findOneBy("administrateur", ["login" => $login]);
        if($admin != null){
            if($admin["motDePasse"] == sha1($motDePasse)){
                connectAdmin($admin["id"]);
                header("Location:../index.php");
                exit();
            }else{
                $message = "Mot de passe incorrect";
            }
        }else{
            $message = "Login non reconnu";
        }
    }
?>
<?php $_TITLE = "Connexion | Administration | THBS"; ?>
<?php $_PAGE_TITLE = "Connexion" ?>
<?php ob_start(); ?>
    <form method="post">
        <span>
            <label for="login">Login</label>
            <input type="text" name="login" id="login" required/>
        </span>
        <span>
            <label for="mot-de-passe" >Mot de passe</label>
            <input type="password" name="mot-de-passe" id="mot-de-passe" required/>
        </span>
        <div class="btns">
            <button type="submit" class="btn btn-primary" name="connexion-administrateur">Continuer</button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean() ?>
<?php require "base.php"; ?>