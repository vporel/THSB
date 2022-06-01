<?php 
/**
 * Contient des éléments qui seront utilisés par les différentes pages comme le nom de la mairie
 */
session_start();
const ROOT = __DIR__."/..";
require_once ROOT."/configuration/config.php";
require_once ROOT."/biblio/biblio.php";
if(!isset($_INSTALLATION["etape"]) or $_INSTALLATION["etape"] < 5){
    header("Location:admin/installation.php");
    exit();
}
$decoupageNomDuScript = explode("/", $_SERVER["SCRIPT_FILENAME"]);
$nomPage = $decoupageNomDuScript[count($decoupageNomDuScript)-1];
if($nomPage == "index.php"){
    $idPage = 0;
}else{
    foreach($_FONCTIONNALITES_DISPONIBLES as $index => $fonc){
        if($fonc["page"] == $nomPage){
            $idPage = $index;
            break;
        }
    }
}
$ipVisiteur = $_SERVER["REMOTE_ADDR"];
$vuePage = ["ip_visiteur" => $ipVisiteur, "id_page"=>$idPage];
if(!elementExists("vuePage", $vuePage)){
    save("vuePage", $vuePage);
}