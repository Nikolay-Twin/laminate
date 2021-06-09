<?php

namespace core\system;

use soft\helpers\assert\Assert;
use core\ports\DtoInterface;
/** 
 *  Data Transfer Object
 */ 
class DTO implements DtoInterface, \JsonSerializable 
{
    private $properties = [];
    private $fill = false;

    /**   
    * __isset
    */ 
    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }    
    
    /**
     * __get
     */
    public function __get($name)
    {
        if (!isset($this->properties[$name])) {
            Assert::init()->protertyNotFound($name);
        }
        
        return $this->properties[$name];
    } 

    /**   
    * __clone
    */ 
    protected function __clone()
    {
        $this->fill = true;
    } 
    
    /**
     * __set
     */
    public function __set($name, $value)
    {
        throw new \LogicException('Can not change DTO');
    } 
    
    /**   
    * JSON
    *  
    * @return string
    */ 
    public function __toString()
    {
        return json_encode($this);
    }
    
    /**   
    * jsonSerialize
    *  
    * @return array
    */ 
    public function jsonSerialize()
    {
        return $this->properties;
    }

    /**
     * Return array
     * @return array
     */
    public function __toArray()
    {
        return (array)$this->properties;
    }
    
    /**
    *
    */
    public function show()
    {
        var_dump((array)$this->properties);
        exit;
    }
    
    /**
     * @param array $data
     */
    public function make($data)
    {
        if ($this->fill) {
            throw new \LogicException('Can not change DTO');
        }
     
        switch (true) {
         
            case empty($data) :
                return clone $this;
         
            case is_object($data) :
                return $this->fill($data);
         
            case is_array($data) :
             
                $models = [];
                foreach ($data as $name => $model) {
                    if (!is_array($model)) {
                        $models = $this->fill($data);
                        break;
                    } else {
                        $models[$name] = $this->fill($model);
                    }
                }
                
                return $models;
            
            default:
                throw new \DomainException('Failed to create DTO');
        }
    }
    
    /**
     * @param array|object $models
     *
     * @return object
     */
    private function fill($models)
    {
        if (!is_object($models) && !is_array($models)) {
            throw new \LogicException('Incorrect data format');
        }
        
        $dto = clone $this;
        foreach ($models as $name => $value) {
            $dto->properties[$name] = $value;
        }
      
        return $dto;    
    } 
}