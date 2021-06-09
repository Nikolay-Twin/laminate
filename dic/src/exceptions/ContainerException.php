<?php

namespace dic\exceptions;
 
use Psr\Container\ContainerExceptionInterface; 
 
class ContainerException extends \Exception  implements ContainerExceptionInterface
{
    public function __construct($message) 
    {      
        parent::__construct($message);
    }
}  
