<?php 
/**
 * Contient des éléments qui seront utilisés par les différentes pages comme le nom de la mairie
 */
session_start();
const ROOT = __DIR__."/..";
require_once ROOT."/configuration/config.php";
require_once ROOT."/biblio/biblio.php";
/*
    il est possible d'ouvrir un fichier de l'administration durant l'installation, on vérifie 
    donc si le param_tre installation est dans l'url
*/
$installation = isset($_SESSION["installation"]) && $_SESSION["installation"] == true;
if(!$installation){
    if($_INSTALLATION["etape"] < 5){
        header("Location:installation.php");
        exit();
    }
}