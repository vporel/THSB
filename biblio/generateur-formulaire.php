<?php

require_once __DIR__."/gestionnaire-model.php";

/**
 * @param string $elementType
 * @param array $values Les valeurs à mettre dans les différents champs
 * @param string $type add | update
 * 
 * @return [type]
 */
function generateForm(string $elementType, $values = [], string $formType){
    $elementSchema = getElementSchema($elementType);
    $formType = strtolower($formType);
    $html = '<form method="post" enctype="multipart/form-data">';
    foreach($elementSchema->getProperties() as $propertyName => $property){
        $requiredText = $property->isNullable() ? "" : "required";
        $html .= '<span><label for="'.$propertyName.'">'.$property->getLabel().'</label>';
        $value = $values[$propertyName] ?? "";
        if($property instanceof FileProperty){
            if($formType == "update"){
                $requiredText = ""; //Pour une modification on n'est pas obligé de renvoyer l'image
            }
            $html .= '<input type="file" name="'.$propertyName.'" id="'.$propertyName.'" '.$requiredText.'/>';
            if($value != ""){
                $html .= "<font>Actuel : $value</font>";
            }
        }elseif($property->getType() == "boolean"){
            $html .= '<input type="checkbox" name="'.$propertyName.'" id="'.$propertyName.'"/>';
        }elseif(in_array($property->getType(), ["text", "longtext"])){
            $html .= '<textarea name="'.$propertyName.'" id="'.$propertyName.'" '.$requiredText.'>'.$value.'</textarea>';
        }else{
            switch($property->getType()){
                case "int": $type = "number";break;
                case "varchar": $type = "text";break;
                case "date": $type = "date";break;
            }
            $html .= '<input type="'.$type.'" name="'.$propertyName.'" id="'.$propertyName.'" '.$requiredText.' value ="'.$value.'"/>';
        }
        $html .= '</span>';
    }
    $html .= '
        <div class="btns">
            <button type="submit" class="btn btn-primary" name="form-submit">'.($formType == "add" ? "Ajouter" : "Modifier").'</button>
        </div>
    ';
    return $html;
}