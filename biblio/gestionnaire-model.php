<?php
require_once __DIR__."/../classes/ElementSchema.php";
require_once __DIR__."/../model.php";

/**
 * Retourne la définition de l'élément
 * @param string $elementType
 * 
 * @return ElementSchema|null
 */
function getElementSchema(string $elementType):?ElementSchema
{
    global $_MODEL;
    if(array_key_exists($elementType, $_MODEL)){
        return $_MODEL[$elementType];
    }else{
        throw new InvalidArgumentException("Le type d'élément $elementType n'est pas reconnu");
    }
}