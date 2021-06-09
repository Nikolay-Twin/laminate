<?php

namespace Core\system\model;

use soft\helpers\assert\Assert;

/** 
 *  Настройки 
 */ 
class Entity
{
    private $properties;

    /**
    * Ассерт
    */ 
    public function assert()
    { 
        return Assert::init();        
    }
   
    /**
    * Неустановленный атрибут
    */ 
    public function __get($name) 
    {
        Assert::init()->protertyNotFound($name);
    }  
   
    /**
    * Выполняет get{Name}() или change{Name}()
    */ 
    public function __call($method, $params)
    { 
        if (empty($this->properties)) {
            $this->properties = get_object_vars($this);
        }
     
        $method = strtolower($method);
        foreach($this->properties as $property => $v) {
            $key = strtolower($property);  
            switch(true)
            {
                case ($method === 'get'. $key) :
                    return $this->$property;
             
                case ($method === 'change'. $key) : 
                    return $this->changeValue($property, $params[0]);   
            }
        }
        
        $rootName = get_called_class();        
        throw new \BadMethodCallException('Method '. $rootName .'::'. $method .' not found. 
                                           Check the availability or access level of the property.
                                           He must be "protected"');
    } 
    
    /**
    * 
    */ 
    private function changeValue($property, $value)
    { 
        if ($property === 'id') {
            throw new \BadMethodCallException('Сannot change ID');
        }
     
        $this->$property = $value;
        $namespace = preg_replace('~(.+)\\\.*~ui', '$1', get_called_class());
        $event = '\\'. $namespace .'\events\Change'. ucfirst($property);
        $id = !empty($this->id) ? $this->id : $this->properties->id;
        
        if (class_exists($event)) {
            $this->recordEvent(new $event($id, $value));
        }
        
        return $this;
    } 
}
