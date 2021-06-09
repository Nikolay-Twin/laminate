<?php

namespace Soft\helpers\security;

/** 
 * 
 */  

class SecurityException extends \Exception
{
    public function __construct($message, $code = null, $file = null, $line = null) 
    {     
        parent::__construct($message, $code);
    }
}  