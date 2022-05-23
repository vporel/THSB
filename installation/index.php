<?php 
    require "../configuration/chemins.php";
    //Détermination de l'étape de l'installation
    $installation = json_decode(file_get_contents(CONFIG_INSTALLATION), true);
    $mairie = json_decode(file_get_contents(CONFIG_MAIRIE), true);
    //Traitement des formulaires
    if(isset($_POST["nom-mairie"])){ // etape1.php
        $nomMairie = trim($_POST["nom-mairie"]);
        if($nomMairie != ""){
            $installation["etape"] = 2; // PAssage à l'étape 2
            $mairie["nom"] = $nomMairie;
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
            $installation["etape"] = 3; // P&ssage à l'étape 3
            $mairie["base-de-donnees"] = [
                "nom" => $nom,
                "hote" => $hote,
                "nom-utilisateur" => $nomUtilisateur,
                "mot-de-passe" => $motDePasse,
            ];
        }else{
            $message = "Vous devez remplir les champs marqués d'une astérisque";
        }
    }

    if(isset($_POST["fonctionnalites"])){ // etape3.php
        $installation["etape"] = 4; // P&ssage à l'étape 4
        $mairie["fonctionnalites"] = $_POST["fonctionnalites"];
    }

    if(isset($_POST["compte-administrateur"])){ // etape4.php
        $login = trim($_POST["login"]);
        $motDePasse = $_POST["mot-de-passe"];
        $confirmMotDePasse = $_POST["confirm-mot-de-passe"];
        if($login != "" && $motDePasse != "" && $confirmMotDePasse != ""){
            if($motDePasse == $confirmMotDePasse){
                $installation["etape"] = 5; // P&ssage à l'étape 5 //Fin de l'installation
            }else{
                $message = "Les mots de passe ne sont pas identiques";
            }
        }else{
            $message = "Vous devez remplir tous les champs";
        }
    }
    if($installation["etape"] == 5){
        header("Location:../index.php"); // Renvoie vers la page du site
    }

    //Enregistrement de smodifications faites dans les fichiers de configuration
    file_put_contents(CONFIG_INSTALLATION, json_encode($installation));
    file_put_contents(CONFIG_MAIRIE, json_encode($mairie));
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
            <h2>Etape <?= $installation["etape"] ?> | Installation | THBS</h2>
            <p>Town Hall Site Builder</p>
        </header>
        <?php if(isset($message)){ ?>
            <div class="alert alert-warning" style="margin:10px;">
                <?= $message ?>
            </div>
        <?php } ?>
        <?php include "etape".$installation["etape"].".php"; ?>
    </div>
</body>
</html>