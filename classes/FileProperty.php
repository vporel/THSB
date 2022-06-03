<?php 
require_once __DIR__."/Property.php";
class FileProperty extends Property{
    /**
     * @var string
     */
    private $folder;

    /**
     * @var array
     */
    private $extensions;
    
    public function __construct(string $name, string $label, string $folder, $extensions = [], bool $nullable = false, ){
        $this->folder = $folder;
        $this->extensions = $extensions;
        parent::__construct($name, $label, "varchar", 255, $nullable);
    }


    /**
     * Get the value of extensions
     *
     * @return  array
     */ 
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Get the value of folder
     *
     * @return  string
     */ 
    public function getFolder()
    {
        return $this->folder;
    }
}