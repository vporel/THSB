<?php
class DBManagerException extends \Exception
{
    public function __construct($msg)
    {
        parent::__construct($msg);
    }
}