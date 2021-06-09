<?php

namespace Core\system\exceptions;

/** 
 * EmptyFormException
 */  

class RepositoryException extends \Exception
{
    const FAILED_ADD    = 1;
    const FAILED_GET    = 2;
    const FAILED_SAVE   = 3;
    const FAILED_REMOVE = 4;
    const NOT_FOUND     = 5;
    
    public function __construct($message, $code = 0, $file = null, $line = null) 
    {     
        parent::__construct($message, $code);
    }
}  