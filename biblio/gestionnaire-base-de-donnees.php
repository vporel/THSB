<?php
$_BDD = null;


require_once __DIR__."/../classes/ElementSchema.php";
require_once __DIR__."/../classes/FileUpload.php";
require_once __DIR__."/../classes/FileUploadException.php";
require_once __DIR__."/../classes/DBManagerException.php";
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



function findBy(string $elementType, array $criteria, string $orderBy = null, int $limit = null):?array
{
    $elementSchema = getElementSchema($elementType);
    $query = "SELECT * FROM ".$elementSchema->getTable();
    if($criteria != null && is_array($criteria)){
        $whereStatements = [];
        $whereStatementsValues = [];
        foreach($criteria as $key => $value){
            if($key == "id" || array_key_exists($key, $elementSchema->getProperties())){
                $whereStatements[] = "$key = ?";
                $whereStatementsValues[] = $value;
            }else{
                throw new InvalidArgumentException("La propriété '$key' dans les critères n'est pas reconnue");
            }
        }
        if(count($whereStatements) > 0){
            $query .= " WHERE ".implode(" AND ", $whereStatements);
        }
    }
    //Order
    if($orderBy != null){
        if(substr($orderBy, 0,1) == "-"){
            $query .= " ORDER BY ".substr($orderBy, 1)." DESC";
        }else{
            $query .= " ORDER BY ".$orderBy;
        }
    }
    if($limit != null){
        $query .= " LIMIT 0, $limit";
    }
    $bdd = connectDB();
    $req = $bdd->prepare($query);
    $req->execute($whereStatementsValues ?? []);
    $elements = [];
    while($element = $req->fetch(PDO::FETCH_ASSOC))
        $elements[] = $element;
    return $elements;
}
function findAll(string $elementType):?array
{
    return findBy($elementType, []);
}

function findOneBy(string $elementType, array $criteria):?array
{
    $elements = findBy($elementType, $criteria);
    return $elements[0] ?? null;
}

/**
 * @param string $elementType
 * @param int $id
 * 
 * @return array|null
 */
function findById(string $elementType, int $id):?array
{
    return findOneBy($elementType, ["id" => $id]);
}


/**
 * @param string $elementType Un type défini dans le fichier model.php
 * @param array $propertiesValues
 * 
 * @return string|null Identifiant de l'élément ajouté
 */
function save(string $elementType, array $propertiesValues):?string
{
    $elementSchema = getElementSchema($elementType);
    $propertiesNames = array_keys($elementSchema->getProperties());
    $questionMarks = [];
    foreach($propertiesNames as $p){
        $questionMarks[] = "?";
    }
    $query = "INSERT INTO ".$elementSchema->getTable()."(".implode(", ", $propertiesNames).") VALUES(".implode(", ",$questionMarks).")";
    $values = [];
    foreach($elementSchema->getProperties() as $propertyName => $property){
        $value = $propertiesValues[$propertyName] ?? null;
        if($property instanceof FileProperty){
            try{
                $value = FileUpload::upload($propertyName, $property->getFolder(), $property->getExtensions());
            }catch(FileUploadException $e){
                if($e->getCode() == FileUploadException::FILE_NOT_RECEIVED){               
                    throw new DBManagerException("Choisissez un fichier pour le champ $propertyName");
                }else{               
                    throw new DBManagerException($e->getMessage());
                }
            }
        }
        if($value === null){
            
            if(!$property->isNullable()){
                throw new DBManagerException("La valeur pour la propriété $propertyName ne peut être nulle");
            }
        }
        $values[] = $value;
    }

    $bdd = connectDB();
    $req = $bdd->prepare($query);
    $req->execute($values);
    return $bdd->lastInsertId();
}

/**
 * @param string $elementType Un type défini dans le fichier model.php
 * @param int $idElement
 * @param array $propertiesValues
 * 
 * @return bool True si la modification a été effectuée avec succès
 */
function update(string $elementType, int $idElement, array $propertiesValues):bool
{
    $elementSchema = getElementSchema($elementType);
    $updates = [];
    $values = [];
    foreach($elementSchema->getProperties() as $propertyName => $property){
        if($property instanceof FileProperty){
            try{
                $values[] = FileUpload::upload($propertyName, $property->getFolder(), $property->getExtensions());
                $updates[] = "$propertyName = ?";
            }catch(FileUploadException $e){
                if($e->getCode() != FileUploadException::FILE_NOT_RECEIVED){               
                    throw new DBManagerException($e->getMessage());
                }
            }
        }else{
            $value = $propertiesValues[$propertyName] ?? null;
            if($value === null){
                
                if(!$property->isNullable()){
                    throw new DBManagerException("La valeur pour la propriété $propertyName ne peut être nulle");
                }
            }
            $updates[] = "$propertyName = ?";
            $values[] = $value;
        }
    }
    $query = "UPDATE ".$elementSchema->getTable()." SET ".implode(", ",$updates)." WHERE id = $idElement";
    $bdd = connectDB();
    $req = $bdd->prepare($query);
    return $req->execute($values);
}

/**
 * @param string $elementType Un type défini dans le fichier model.php
 * @param int $idElement
 * 
 * @return bool True si la suppression a été effectuée avec succès
 */
function delete(string $elementType, int $idElement):bool
{
    $elementSchema = getElementSchema($elementType);
    $query = "DELETE FROM ".$elementSchema->getTable()." WHERE id = $idElement";
    $bdd = connectDB();
    return $bdd->exec($query);
}

function createTables($bdd){
    global $_MODEL;
    foreach($_MODEL as $elementType => $elementSchema){
        createTable($bdd, $elementSchema);
    }
}

function createTable($bdd, ElementSchema $elementSchema)
{
    $query = "
        CREATE TABLE IF NOT EXISTS ".$elementSchema->getTable()."(
            id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY
        ";
    $fieldsQueryParts = [];
    foreach($elementSchema->getProperties() as $property){
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