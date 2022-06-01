<?php 
/**
 * Contient des éléments qui seront utilisés par les différentes pages comme le nom de la mairie
 */
session_start();
const ROOT = __DIR__."/..";
require_once ROOT."/configuration/config.php";
require_once ROOT."/biblio/biblio.php";
if(!isset($_INSTALLATION["etape"]) or $_INSTALLATION["etape"] < 5){
    header("Location:installation");
    exit();
}