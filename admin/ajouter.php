<?php 
    require "./head.php";
    require_once __DIR__."/../classes/DBManagerException.php";
    if(!isAdminConnected()){
        header("Location:index.php");
        exit();
    }
    $elementType = $_GET["elementType"] ?? null;
    if($elementType == null || !array_key_exists($elementType, $_MODEL)){
        echo "La requête n'a pas pu être traitée. Le type d'élément n'existe pas dans l'URL. <br><a href='../index.php'>Retourner au site</a>";
        exit();
    }
    $form = generateForm($elementType, $_POST, "add");
    if(isset($_POST["form-submit"])){
        $nom = $_POST["nom"];
        $elementExistant = findOneBy($elementType, ["nom"=>$nom]);
        if($elementExistant === null){
            try{
                $idProjet = save($elementType, $_POST);
                if($idProjet > 0){
                    $message = "Elément ajouté avec succès";
                    $form = generateForm($elementType, [], "add"); // On vide le formulaire
                }
            }catch(DBManagerException $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "Un élément du nom '$nom' existe déjà";
        }
    }
    
?>
<?php $_TITLE = "Ajouter | ".ucfirst($elementType)." | THBS"; ?>
<?php $_PAGE_TITLE = "Ajouter | ".ucfirst($elementType); ?>
<?php $_CONTENT = $form ?>
<?php require "base.php"; ?>