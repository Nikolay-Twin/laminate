<?php

namespace Soft\helpers\assert;

/** 
 * EmptyFormException
 */  

class AssertException extends \Exception
{
    public function __construct($message, $code = null, $file = null, $line = null) 
    {     
        parent::__construct($message, $code);
    }
}  