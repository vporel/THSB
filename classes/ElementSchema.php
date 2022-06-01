<?php
require_once __DIR__."/Property.php";
class ElementSchema{
    /**
     * @var string
     */
    private $table;
    /**
     * @var string
     */
    private $page;

    /**
     * @var array
     */
    private $properties = [];

    /**
     * @var array
     */
    private $validationRules = [];

    /**
     * @param string $table La table (dans la base de données) 
     * @param array $properties Tableau des propriétés de l'élément. Ce tableau contient des instances de la classe Property
     * @param string $page Le chemin vers la page qui présente les éléments (sans l'extension) - La racine est le dossier du projet
     * @param array $validationRules Tableau des règles de validation pour une instance de l'élément. LEs éléments de ce tableau sont des instances d ela classe ValidationRule
     */
    public function __construct(string $table, array $properties, string $page = null, array $validationRules = []){
        $this->table = $table;
        $this->validationRules = $validationRules;
        $this->page = $page != null ? $page.".php" : null;
        foreach($properties as $property){
            if(is_object($property) && $property instanceof Property){
                $this->properties[$property->getName()] = $property;
            }
        }
    }

    /**
     * Get the value of properties
     *
     * @return  array
     */ 
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Get the value of validationRules
     *
     * @return  array
     */ 
    public function getValidationRules()
    {
        return $this->validationRules;
    }

    /**
     * Get the value of table
     *
     * @return  string
     */ 
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Get the value of page
     *
     * @return  string
     */ 
    public function getPage()
    {
        return $this->page;
    } 
}