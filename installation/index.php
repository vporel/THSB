<?php 
    session_start();
    require "../configuration/config.php";
    require "../biblio/biblio.php";
    //Détermination de l'étape de l'installation
    //Traitement des formulaires
    if(isset($_POST["nom-mairie"])){ // etape1.php
        $nomMairie = trim($_POST["nom-mairie"]);
        if($nomMairie != ""){
            $_INSTALLATION["etape"] = 2; // PAssage à l'étape 2
            $_MAIRIE["nom"] = $nomMairie;
        }else{
            $message = "Entrez le nom de la mairie";
        }
    }

    if(isset($_POST["base-de-donnees"])){ // etape2.php
        $nom = trim($_POST["nom-bd"]);
        $hote = trim($_POST["hote-bd"]);
        $nomUtilisateur = trim($_POST["nom-utilisateur-bd"]);
        $motDePasse = $_POST["mot-de-passe-bd"];
        if($nom != "" && $hote != "" && $nomUtilisateur != ""){
            
            //Essaie de connexion à la base de données
            try{
                $bdd = new PDO("mysql:host=$hote;dbname=$nom", $nomUtilisateur, $motDePasse);
                //Création des tables
                try{
                    createTables($bdd);
                    $_MAIRIE["base-de-donnees"] = [
                        "nom" => $nom,
                        "hote" => $hote,
                        "nom-utilisateur" => $nomUtilisateur,
                        "mot-de-passe" => $motDePasse,
                    ];
                    $_INSTALLATION["etape"] = 3; // P&ssage à l'étape 3
                }catch(PDOException $e){
                    echo $e->getMessage();
                    $message = "Echec de la création des tables dans la base de données";
                }
                
            }catch(PDOException $e){
                if($e->getCode() == 2002){
                    $message = "Hôte '$hote' injoignable";
                }elseif($e->getCode() == 1049){
                    $message = "Base '$nom' inexistante";
                }elseif($e->getCode() == 1044){
                    $message = "Nom d'utilisateur $nomUtilisateur non reconnu";
                }elseif($e->getCode() == 1045){
                    $message = "Le mot de passe $motDePasse ne correspond pas";
                }else{
                    $message = "Echec de la connexion à la base $nom. Vérifiez les informations entrées";
                }
            }
            
        }else{
            $message = "Vous devez remplir les champs marqués d'une astérisque";
        }
    }

    if(isset($_POST["fonctionnalites"])){ // etape3.php
        $_INSTALLATION["etape"] = 4; // P&ssage à l'étape 4
        $_MAIRIE["fonctionnalites"] = $_POST["fonctionnalites"];
    }

    if(isset($_POST["compte-administrateur"])){ // etape4.php
        $login = trim($_POST["login"]);
        $motDePasse = $_POST["mot-de-passe"];
        $confirmMotDePasse = $_POST["confirm-mot-de-passe"];
        if($login != "" && $motDePasse != "" && $confirmMotDePasse != ""){
            if($motDePasse == $confirmMotDePasse){
                $id = save("administrateur", ["login" => $login, "motDePasse" => sha1($motDePasse)]);
                connectAdmin($id);
                $_INSTALLATION["etape"] = 5; // P&ssage à l'étape 5 //Fin de l'installation
            }else{
                $message = "Les mots de passe ne sont pas identiques";
            }
        }else{
            $message = "Vous devez remplir tous les champs";
        }
    }
    if($_INSTALLATION["etape"] == 5){
        header("Location:../index.php"); // Renvoie vers la page du site
    }

    //Enregistrement de smodifications faites dans les fichiers de configuration
    file_put_contents(CONFIG_INSTALLATION, json_encode($_INSTALLATION));
    file_put_contents(CONFIG_MAIRIE, json_encode($_MAIRIE));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation | THBS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="../assets/js/biblio.js"></script>
</head>
<body>
    <div id="page">
        <header>
            <h2>Etape <?= $_INSTALLATION["etape"] ?> | Installation | THBS</h2>
            <p>Town Hall Site Builder</p>
        </header>
        <?php if(isset($message)){ ?>
            <div class="alert alert-warning" style="margin:10px;">
                <?= $message ?>
            </div>
        <?php } ?>
        <?php include "etape".$_INSTALLATION["etape"].".php"; ?>
    </div>
</body>
</html>