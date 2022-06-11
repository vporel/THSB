<?php 
require_once __DIR__."/Property.php";

/**
 * Champ texte (type varchar) proposant des valeurs à choisir
 */
class EnumProperty extends Property{
    /**
     * @var array les valeurs proposées
     */
    private $values;

    /**
     * Si à true, l'utilisateur peut mettre une valeur différente de celle proposée dans la liste
     * @var bool 
     */
    private $extendable;

    /**
     * @var array
     */
    private $extensions;
    
    public function __construct(string $name, string $label, array $values, bool $nullable = false, bool $extendable = false){
        $this->values = $values;
        $this->extendable = $extendable;
        parent::__construct($name, $label, "varchar", 255, $nullable);
    }


    

    /**
     * Get si à true, l'utilisateur peut mettre une valeur différente de celle proposée dans la liste
     *
     * @return  bool
     */ 
    public function isExtendable()
    {
        return $this->extendable;
    }

    /**
     * Get les valeurs proposées
     *
     * @return  array
     */ 
    public function getValues()
    {
        return $this->values;
    }
}