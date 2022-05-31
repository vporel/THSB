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
    if(isset($_POST["supprimer"])){
        if(delete($elementType, $idElement, $_POST)){
                header("Location:../".$elementSchema->getPage());
        }else{
            $message = "Echec de la suppression";
        }
    }
    
?>
<?php $_TITLE = "Supprimer | ".ucfirst($elementType)." | ".$element["nom"]." | THBS"; ?>
<?php $_PAGE_TITLE = "Supprimer | ".ucfirst($elementType)." | ".$element["nom"] ?>
<?php ob_start(); ?>
    <form method="post">
        <center>
        <p>
            Etes-vous sûr de vouloir supprimer l'élément '<?= $element["nom"] ?>' ?<br>
            <i><strong>Cette action est irreversible</strong></i>
        </p>
        </center>
        <div class="btns">
            <button type="submit" class="btn btn-bad" name="supprimer">Supprimer</button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean() ?>
<?php require "base.php"; ?>