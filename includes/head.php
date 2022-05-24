<?php 
/**
 * Contient des éléments qui seront utilisés par les différentes pages comme le nom de la mairie
 */
session_start();
require __DIR__."/../configuration/chemins.php";

$_MAIRIE = json_decode(file_get_contents(CONFIG_MAIRIE), true);