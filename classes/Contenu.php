<?php
require_once __DIR__."/ElementSchema.php";
require_once __DIR__."/Property.php";
require_once __DIR__."/FileProperty.php";
/**
 * Les éléments tels que projets, activités, annonces
 */
class Contenu extends ElementSchema{
   

    /**
     * @param string $table La table (dans la base de données) 
     * @param array $properties Tableau des propriétés de l'élément. Ce tableau contient des instances de la classe Property
     * @param string $imagesFolder 
     * @param string $page Le chemin vers la page qui présente les éléments (sans l'extension) - La racine est le dossier du projet
     * @param array $validationRules Tableau des règles de validation pour une instance de l'élément. LEs éléments de ce tableau sont des instances d ela classe ValidationRule
     */
    public function __construct(string $table, array $properties, string $imagesFolder, string $page = null, array $validationRules = []){
        $contenuProperties = [];
        $contenuProperties[] = new Property("nom","Nom", "varchar", 50, false);
        $contenuProperties[] = new Property("description","Description", "text", null, false);
        $contenuProperties[] = new FileProperty("image", "Image", $imagesFolder, ["pdf", "jpg", "jpeg", "png"], true);
        parent::__construct($table, array_merge($contenuProperties, $properties), $page,$validationRules);
    }

}