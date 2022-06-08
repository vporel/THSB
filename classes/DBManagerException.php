<?php
/**
 * Exceptions lancées si une erreur survient dans le gestionnaire de bases de données
 */
class DBManagerException extends \Exception
{
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}