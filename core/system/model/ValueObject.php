<?php

namespace core\system\model;
 
class ValueObject
{
    /**
    * Выполняет get{Name}() или with{Name}() или without{Name}()
    */ 
    public function __call($method, $args)
    { 
        $properties = get_object_vars($this);
        $method = strtolower($method);
     
        foreach($properties as $property => $v) {
            $name = strtolower($property);
            
            switch(true)
            {
                case ($method === 'get'. $name) :
                    return $this->$property;
             
                case ($method === 'with'. $name) :
                    return $this->setValue($property, $args[0]);
             
                case ($method === 'without'. $name) :
                    return $this->setValue($property);
            }
        }
        $voName = get_called_class();
        throw new \BadMethodCallException('Method '. $voName .'::'. $method .' not found. 
                                           Check the availability or access level of the property.
                                           He must be "protected"');   
    } 
    
    /**
    * Клонирует VO, меняет в нем свойство и возвращает новый объект
    */ 
    private function setValue($property, $value = null)
    { 
        $clone = clone $this;
        $clone->$property = $value;
        return $clone;        
    } 
}
