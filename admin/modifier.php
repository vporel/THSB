<?php 
    require "./head.php";
    require_once __DIR__."/../classes/DBManagerException.php";
    if(!isAdminConnected()){
        header("Location:index.php");
        exit();
    }
    $elementType = $_GET["elementType"] ?? null;
    $idElement = $_GET["id"] ?? null;
    if($elementType == null || !array_key_exists($elementType, $_MODEL)){
        echo "La requête n'a pas pu être traitée. Le type d'élément n'existe pas dans l'URL. <br><a href='../index.php'>Retourner au site</a>";
        exit();
    }
    if($idElement == null || $idElement < 1){
        echo "La requête n'a pas pu être traitée. L'id de l'élément à modifier n'est pas valide. <br><a href='../index.php'>Retourner au site</a>";
        exit();
    }
    $element = findById($elementType, $idElement);
    if($element == null){
        echo "La requête n'a pas pu être traitée. Aucun élément ne correspond à l'identifiant passé en paramètre. <br><a href='../index.php'>Retourner au site</a>";
        exit();
    }
    $form = generateForm($elementType, $element, "update");
    if(isset($_POST["form-submit"])){
        try{
            if(update($elementType, $idElement, $_POST)){
                $message = "Elément modifié avec succès";
            }else{
                $message = "Echec de la modification";
            }
        }catch(DBManagerException $e){
            $message = $e->getMessage();
        }
        $form = generateForm($elementType, $_POST, "update");
    }
    
?>
<?php $_TITLE = "Modifier | ".ucfirst($elementType)." | ".$element["nom"]." | THBS"; ?>
<?php $_PAGE_TITLE = "Modifier | ".ucfirst($elementType)." | ".$element["nom"] ?>
<?php $_CONTENT = $form ?>
<?php require "base.php"; ?>