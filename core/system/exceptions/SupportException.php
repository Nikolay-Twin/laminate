<?php

namespace Core\system\exceptions;

/** 
 * EmptyFormException
 */  

class SupportException extends \Exception
{  
    public function __construct($message, $code = 0, $file = null, $line = null) 
    {     
        parent::__construct($message, $code);
    }
}  