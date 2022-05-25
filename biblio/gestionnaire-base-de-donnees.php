<?php
$_BDD = null;


require_once __DIR__."/../classes/Element.php";
require_once __DIR__."/../model.php";

function connectDB():?PDO
{
    global $_BDD;
    global $_MAIRIE;
    if($_BDD == null){
        try{
            $hote = $_MAIRIE["base-de-donnees"]["hote"];
            $nomBDD = $_MAIRIE["base-de-donnees"]["nom"];
            $nomUtilisateur = $_MAIRIE["base-de-donnees"]["nom-utilisateur"];
            $motDePasse = $_MAIRIE["base-de-donnees"]["mot-de-passe"];
            $_BDD = new PDO("mysql:host=$hote;dbname=$nomBDD", $nomUtilisateur, $motDePasse, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            //Création des tables
            
        }catch(PDOException $e){
            //Do noting
        }
    }
    return $_BDD;
}

/**
 * @param string $elementType
 * @param int $id
 * 
 * @return array|null
 */
function findById(string $elementType, int $id):?array
{
    global $_MODEL;
    if(array_key_exists($elementType, $_MODEL)){
        $element = $_MODEL[$elementType];
        $query = "SELECT * FROM ".$element->getTable()." WHERE id = ?";
        $bdd = connectDB();
        $req = $bdd->prepare($query);
        $req->execute([$id]);
        return ($req->rowCount() > 0) ? $req->fetch(PDO::FETCH_ASSOC) : null;
    }else{
        throw new InvalidArgumentException("Le type d'élément $elementType n'est pas reconnu");
    }
    return null;
}


/**
 * @param string $elementType Un type défini dans le fichier model.php
 * @param mixed $propertiesValues
 * 
 * @return string|null Identifiant de l'élément ajouté
 */
function save(string $elementType, $propertiesValues):?string
{
    global $_MODEL;
    if(array_key_exists($elementType, $_MODEL)){
        $element = $_MODEL[$elementType];
        $propertiesNames = array_keys($element->getProperties());
        $questionMarks = [];
        foreach($propertiesNames as $p){
            $questionMarks[] = "?";
        }
        $query = "INSERT INTO ".$element->getTable()."(".implode(", ", $propertiesNames).") VALUES(".implode(", ",$questionMarks).")";
        $values = [];
        foreach($element->getProperties() as $propertyName => $property){
            $value = $propertiesValues[$propertyName] ?? null;
            if($value === null){
                if($property->isNullable()){
                    $values[] = null;
                }else{
                    throw new InvalidArgumentException("La valeur pour la propriété $propertyName ne peut être nulle");
                }
            }else{
                $values[] = $value;
            }
        }

        $bdd = connectDB();
        $req = $bdd->prepare($query);
        $req->execute($values);
        return $bdd->lastInsertId();
    }else{
        throw new InvalidArgumentException("Le type d'élément $elementType n'est pas reconnu");
    }
    return null;
}



function createTables($bdd){
    global $_MODEL;
    foreach($_MODEL as $elementType => $element){
        createTable($bdd, $element);
    }
}

function createTable($bdd, Element $element)
{
    $query = "
        CREATE TABLE IF NOT EXISTS ".$element->getTable()."(
            id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY
        ";
    $fieldsQueryParts = [];
    foreach($element->getProperties() as $property){
        $fieldQueryPart = $property->getName()." ".$property->getType();
        if($property->getMaxLength() != null && $property->getMaxLength() > 0){
            $fieldQueryPart .= "(".$property->getMaxLength().")";
        }
        $fieldQueryPart .= $property->isNullable() ? " NULL" : " NOT NULL";
        $fieldsQueryParts[] = $fieldQueryPart;
    }
    if(count($fieldsQueryParts)){
        $query .= ", ".implode(", ", $fieldsQueryParts);
    }
    $query .= ")";
    return $bdd->exec($query);
}