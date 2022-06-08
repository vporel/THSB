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
    $elementSchema = $_MODEL[$elementType];
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
        $nom = $_POST["nom"];
        $elementExistant = findOneBy($elementType, ["nom"=>$nom]);
        if($elementExistant === null || $element["nom"] == $nom){ // Si le nom n'existe pas ou s'il d'agit du nom de l'élément même
            try{
                if(update($elementType, $idElement, parseFormData($elementType, true))){
                    $message = "Elément modifié avec succès";
                }else{
                    $message = "Echec de la modification";
                }
            }catch(DBManagerException $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "Un élément du nom '$nom' existe déjà";
        }
        $form = generateForm($elementType, $_POST, "update");
    }
    
?>
<?php $_TITLE = "Modifier | ".ucfirst($elementType)." | ".$element["nom"]." | THBS"; ?>
<?php $_PAGE_TITLE = "Modifier | ".ucfirst($elementType)." | ".$element["nom"] ?>
<?php ob_start() ?>
    <form method="POST" enctype="multipart/form-data">
        <?= $form ?>
        <div class="btns">
            <button type="submit" class="btn btn-primary" name="form-submit"><object data="../assets/icons/edit.svg" class="icon"></object><em>Modifier</em></button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>