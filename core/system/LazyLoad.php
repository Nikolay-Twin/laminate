<?php

namespace core\system;

use core\system\model\Entity;
use soft\helpers\assert\Assert;

/**
* Отложенная загрузка
*/
class LazyLoad
{
    private $callable;
    private $obj;

    /**
    * __construct
    */ 
    public function __construct($callable)
    {
        $this->callable = $callable;
    }

    /**
    * __call
    */ 
    public function __call($method, $args)
    {
        if (empty($this->obj)) { 
            Assert::init()->isCallable($this->callable);
            $this->obj = $this->callable->__invoke();
        }
        
        return call_user_func_array([$this->obj, $method], $args);
    }     
}
