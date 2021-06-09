<?php

namespace dic\exceptions;
 
use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \Exception  implements NotFoundExceptionInterface
{
    public function __construct($message) 
    {       
        parent::__construct($message);
    }
}  
