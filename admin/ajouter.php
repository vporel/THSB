<?php 
    require "./head.php";
    require_once __DIR__."/../classes/DBManagerException.php";
    if(!$installation && !isAdminConnected()){
        header("Location:../index.php");
        exit();
    }
    $elementType = $_GET["elementType"] ?? null;
    if($elementType == null || !array_key_exists($elementType, $_MODEL)){
        echo "La requête n'a pas pu être traitée. Le type d'élément n'existe pas dans l'URL. <br><a href='../index.php'>Retourner au site</a>";
        exit();
    }
    $elementSchema = $_MODEL[$elementType];
    $form = generateForm($elementType, $_POST, "add");
    if(isset($_POST["form-submit"])){
        $nom = $_POST["nom"];
        $elementExistant = findOneBy($elementType, ["nom"=>$nom]);
        if($elementExistant === null){
            try{
                $idProjet = save($elementType, parseFormData($elementType));
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

<?php ob_start() ?>
    <form method="POST" enctype="multipart/form-data">
        <?= $form ?>
        <div class="btns">
            <button type="submit" class="btn btn-primary" name="form-submit"><object data="../assets/icons/plus.svg" class="icon"></object><em>Ajouter</em></button>
        </div>
    </form>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>