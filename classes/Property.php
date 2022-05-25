<?php 
class Property{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $maxLength;

    /**
     * @var bool
     */
    private $nullable;

    /**
     * @var array
     */
    private $validationRules;

    /**
     * @param string $name
     * @param string $type
     * @param int $maxLength Si égal à null, le champ est d'une longueur non précisée (Ex: champ de type text)
     * @param bool $nullable
     * @param array $validationRules
     */
    public function __construct(string $name, string $type, int $maxLength = null, bool $nullable = false, array $validationRules = []){
        $this->name = $name;
        $this->nullable = $nullable;
        $type = strtolower($type);
        if(in_array($type, ["int", "varchar", "text", "longtext", "boolean"])){
            $this->type = $type;
        }else{
            throw new InvalidArgumentException("Le type $type n'est pas reconnu");
        } 
        if($type == "varchar" && $maxLength != null && $maxLength > 0){
            $this->maxLength = $maxLength;
        }else{
            throw new InvalidArgumentException("Une longueur maximale doit être renseignée pour le type varchar");
        }
        $this->validationRules = $validationRules;
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
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of nullable
     *
     * @return  bool
     */ 
    public function isNullable()
    {
        return $this->nullable;
    }

    /**
     * Get the value of maxLength
     *
     * @return  int
     */ 
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }
}