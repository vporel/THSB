<?php 
    session_start();
    require "../configuration/config.php";
    require "../biblio/biblio.php";
    $_SESSION["installation"] = true;

    //Détermination de l'étape de l'installation
    //Traitement des formulaires
    if(isset($_POST["mode-installation"])){ // etape1.php
        $_INSTALLATION["mode"] = $_POST["mode-installation"];
        $_INSTALLATION["etape"] = 2;
    }

    if(isset($_POST["base-de-donnees"])){ // etape2.php
        /* Avec un base mysql 
            $nom = trim($_POST["nom-bd"]);
            $hote = trim($_POST["hote-bd"]);
            $nomUtilisateur = trim($_POST["nom-utilisateur-bd"]);
            $motDePasse = $_POST["mot-de-passe-bd"];
            if($nom != "" && $hote != "" && $nomUtilisateur != ""){
                
                //Essaie de connexion à la base de données
                try{
                    
                    $bdd = new PDO("mysql:host=$hote;dbname=$nom", $nomUtilisateur, $motDePasse);
                    
                }catch(PDOException $e){
                    if($e->getCode() == 2002){
                        $message = "Hôte '$hote' injoignable";
                    }elseif($e->getCode() == 1049){
                        $message = "Base '$nom' inexistante";
                    }elseif($e->getCode() == 1044){
                        $message = "Nom d'utilisateur '$nomUtilisateur' non reconnu";
                    }elseif($e->getCode() == 1045){
                        $message = "Le mot de passe '$motDePasse' ne correspond pas au nom d'utilisateur '$nomUtilisateur'";
                    }else{
                        $message = "Echec de la connexion à la base '".FICHIER_BASE_DE_DONNEES."'. Vérifiez les informations entrées";
                    }
                }
                if(isset($bdd) && $bdd != null){
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
                }
            }else{
                $message = "Vous devez remplir les champs marqués d'une astérisque";
            }
        */
        //Essaie de connexion à la base de données
        try{
            $bdd = new PDO("sqlite:".FICHIER_BASE_DE_DONNEES);
        }catch(PDOException $e){
            $message = "Echec de la connexion à la base '".FICHIER_BASE_DE_DONNEES."'.<br>Vérifiez que droits d'écriture sur le dossier du projet sont accordés<br>Ou contactez l'un des développeurs <dev.vporel@gmail.com>";
        }
        if(isset($bdd) && $bdd != null){
            try{
                createTables($bdd);
                $_INSTALLATION["etape"] = 3; // P&ssage à l'étape 3
            }catch(PDOException $e){
                echo $e->getMessage();
                $message = "Echec de la création des tables dans la base de données";
            }
        }
    }

    if(isset($_POST["fonctionnalites"])){ // etape4.php
        $_INSTALLATION["etape"] = 5; // P&ssage à l'étape 5
        $_MAIRIE["fonctionnalites"] = $_POST["fonctionnalites"];
    }

    if(isset($_POST["compte-administrateur"])){ // etape5.php
        $login = trim($_POST["login"]);
        $motDePasse = $_POST["mot-de-passe"];
        $confirmMotDePasse = $_POST["confirm-mot-de-passe"];
        if($login != "" && $motDePasse != "" && $confirmMotDePasse != ""){
            if($motDePasse == $confirmMotDePasse){
                $id = save("administrateur", ["login" => $login, "motDePasse" => sha1($motDePasse)]);
                connectAdmin($id);
                $_INSTALLATION["etape"] = 6; // P&ssage à l'étape 6 //Fin de l'installation
            }else{
                $message = "Les mots de passe ne sont pas identiques";
            }
        }else{
            $message = "Vous devez remplir tous les champs";
        }
    }

    if($_INSTALLATION["etape"] == 3){//
        $_LIENS_ETAPE_3 = [
            "modifier-info-mairie.php?infoType=nom",
            "modifier-info-mairie.php?infoType=historique",
            "modifier-info-mairie.php?infoType=missions",
        ];
        if(isset($_SESSION["installation-niveau-etape-3"]))
            $niveauEtape3 = $_SESSION["installation-niveau-etape-3"];
        else
            $niveauEtape3 = $_INSTALLATION["niveau-etape-3"] ?? 0;//0 pour le premier element du tableau
        $nombreNiveauxEtape3 = 1;
        if($_INSTALLATION["mode"] == 2) // Installation complète
            $nombreNiveauxEtape3 = count($_LIENS_ETAPE_3);
        if($niveauEtape3 >= $nombreNiveauxEtape3){//Si tous les liens ont étés suivi et que les infos ont été renseignées
            $_INSTALLATION["etape"] = 4;
            unset($_SESSION["installation-niveau-etape-3"]);
        }else{
            $_SESSION["installation-niveau-etape-3"] = $niveauEtape3;
            header("Location:".$_LIENS_ETAPE_3[$niveauEtape3]);
        }
    }

    //Enregistrement des modifications faites dans les fichiers de configuration
    file_put_contents(FICHIER_CONFIG_INSTALLATION, json_encode($_INSTALLATION));
    file_put_contents(FICHIER_CONFIG_MAIRIE, json_encode($_MAIRIE));
    if($_INSTALLATION["etape"] == 6){
        $_SESSION["installation"] = false;
        file_put_contents(FICHIER_CONFIG_INSTALLATION, json_encode($_INSTALLATION));
        header("Location:../index.php"); // Renvoie vers la page du site
        exit();
    }
    $installation = true;
?>
<?php $_TITLE = "Etape ".$_INSTALLATION["etape"]." | Installation | THBS"; ?>
<?php ob_start(); ?>

    <?php include "installation/etape".$_INSTALLATION["etape"].".php"; ?>
<?php $_CONTENT = ob_get_clean() ?>
<?php require "base.php"; ?>