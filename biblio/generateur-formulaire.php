<?php

require_once __DIR__."/gestionnaire-model.php";

/**
 * Générer automatiquement le code HTML pour le formulaire correspondant à l'elementType en paramètre
 * Les champs du formulaire sont les éléments de la propriété $properties du schéma de l'élément
 * @param string $elementType
 * @param array $values Les valeurs à mettre dans les différents champs
 * @param string $type add | update
 * 
 * @return [type]
 */
function generateForm(string $elementType, $values = [], string $formType = "add"){
    $elementSchema = getElementSchema($elementType);
    $formType = strtolower($formType);
    $html = '';
    foreach($elementSchema->getProperties() as $propertyName => $property){
        $requiredText = $property->isNullable() ? "" : "required";
        $html .= '<span><label for="'.$propertyName.'">'.$property->getLabel().'</label>';
        $value = $values[$propertyName] ?? "";
        if($property instanceof FileProperty){
            if($formType == "update"){
                $requiredText = ""; //Pour une modification on n'est pas obligé de renvoyer l'image
            }
            $html .= '<input type="file" name="'.$propertyName.'" id="'.$propertyName.'" '.$requiredText.' '.((count($property->getExtensions())>0) ?  'accept=".'.implode(',.', $property->getExtensions()).'"' : "").'/>';
            if($value != ""){
                $html .= "<font>Actuel : $value</font>";
            }
        }elseif($property instanceof EnumProperty){
            
            $value = !is_array($value) ? $value : ((count($value) > 1 && $value[1] != "") ? $value[1] : $value[0]);
            $html .= "<select name='".$propertyName."[]' id='$propertyName' $requiredText>";
            foreach($property->getValues() as $v){
                $html .= "<option value='$v' ".($v == $value ? "selected" : "").">$v</option>";
            }
            if($property->isExtendable()){
                $html .= "<input type='text' name='".$propertyName."[]' placeholder='Autre' value='".(!in_array($value, $property->getValues()) ? $value : "")."' style='margin-top:5px'/>";
            }
            $html .= '</select>';
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
    return $html;
}

/**
 * Recupère un tableau des données transformées apr_s l'envoie du formulaires
 * Les fichiers qui ne sont pas dans la variable $_POST mais pluôt dans $_FILES seront automatiquement téléchargés
 * @param string $elementType
 * @param bool $ignoreMissingFiles Si à true, les fichiers non envoyés par l'utilisateur et dont les champs en bd sont non nullables lèveront pas une exception
 * 
 * @return [type]
 */
function parseFormData(string $elementType, bool $ignoreMissingFiles = false){
    $elementSchema = getElementSchema($elementType);
    $data = [];
    foreach($elementSchema->getProperties() as $propertyName => $property){
        $value = $_POST[$propertyName] ?? null;
        if($property instanceof FileProperty){
            try{
                $value = FileUpload::upload($propertyName, $property->getFolder(), $property->getExtensions());
                
                $data[$propertyName] = $value;
            }catch(FileUploadException $e){
                if($e->getCode() == FileUploadException::FILE_NOT_RECEIVED){    
                    if(!$ignoreMissingFiles && !$property->isNullable())           
                        throw new DBManagerException("Choisissez un fichier pour le champ $propertyName");
                }else{               
                    throw new DBManagerException($e->getMessage());
                }
            }
        }elseif($property instanceof EnumProperty){
            //Pour ce champ la valeur dans $_POST est un tableau
            $value = (count($value) > 1 && $value[1] != "") ? $value[1] : $value[0];
        }else{
            if($value === null && !$property->isNullable()){
                throw new DBManagerException("La valeur pour la propriété $propertyName ne peut être nulle");
                
            }
            $data[$propertyName] = $value;
        }
    }
    return $data;

}