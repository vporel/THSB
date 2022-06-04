<?php
require_once __DIR__."/../configuration/config.php";
require_once __DIR__."/gestionnaire-model.php";
require_once __DIR__."/generateur-formulaire.php";
require_once __DIR__."/gestionnaire-base-de-donnees.php";
require_once __DIR__."/session-administrateur.php";


/**
 * Parcourir la chaine pour la mise en forme
 * suivant les règles définies
 */
function updateText(string $text){
    $text = preg_replace("#\*([^*]+)\*#", "<strong>$1</strong>", $text);
    $text = preg_replace("#_([^_]+)_#", "<i>$1</i>", $text);
    $text = preg_replace("#@([^@]+)@#", "<u>$1</u>", $text);
    $text = preg_replace("#>>#","&emsp;", $text);
    return $text;
}