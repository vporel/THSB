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
            /*
                Utilisation d'une base mysql
                $hote = $_MAIRIE["base-de-donnees"]["hote"];
                $nomBDD = $_MAIRIE["base-de-donnees"]["nom"];
                $nomUtilisateur = $_MAIRIE["base-de-donnees"]["nom-utilisateur"];
                $motDePasse = $_MAIRIE["base-de-donnees"]["mot-de-passe"];
                $_BDD = new PDO("mysql:host=$hote;dbname=$nomBDD", $nomUtilisateur, $motDePasse, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            */
            $_BDD = new PDO("sqlite:".FICHIER_BASE_DE_DONNEES);
            
        }catch(PDOException $e){
            echo "Echec de la connexion à la base de données<br><br>";
            /*
                Utilisation dune base mysql
                if($e->getCode() == 2002){
                    $message = "Hôte '$hote' injoignable";
                }elseif($e->getCode() == 1049){
                    $message = "Base '$nomBDD' inexistante";
                }elseif($e->getCode() == 1044){
                    $message = "Nom d'utilisateur '$nomUtilisateur' non reconnu";
                }elseif($e->getCode() == 1045){
                    $message = "Le mot de passe '$motDePasse' ne correspond pas au nom d'utilisateur '$nomUtilisateur'";
                }else{
                    $message = "Echec de la connexion à la base '$nomBDD'. Vérifiez les informations dans le fichier de configuration";
                }
            */
            exit();
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

function elementExists(string $elementType, array $criteria):bool
{
    return findOneBy($elementType, $criteria) != null;
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
function save(string $elementType, array $data):?string
{
    $elementSchema = getElementSchema($elementType);
    $questionMarks = [];
    $values = [];
    foreach($data as $value){
        $questionMarks[] = "?";
        $values[] = $value;
    }
    $propertiesNames = array_keys($elementSchema->getProperties());
    $query = "INSERT INTO ".$elementSchema->getTable()."(".implode(", ", $propertiesNames).") VALUES(".implode(", ",$questionMarks).")";
    

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
function update(string $elementType, int $idElement, array $data):bool
{
    $elementSchema = getElementSchema($elementType);
    $updates = [];
    $values = [];
    foreach($data as $propertyName => $value){
        $updates[] = "$propertyName = ?";
        $values[] = $value;
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
    /*
        Utilisation d'une base mysql
        $query = "
            CREATE TABLE IF NOT EXISTS ".$elementSchema->getTable()."(
                id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY
            ";
    */
    $query = "
        CREATE TABLE IF NOT EXISTS ".$elementSchema->getTable()."(
            id INTEGER PRIMARY KEY
        "; // Sur sqlite, autoincrement est en un mot
        
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