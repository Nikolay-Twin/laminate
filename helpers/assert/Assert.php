<?php

namespace Soft\helpers\assert;

use Soft\helpers\assert\AssertException;

/**
* Внутренняя валидация
*/
class Assert
{
    protected static $inst;
    /**
    * Инсталяция объекта
    */ 
    public static function init()
    {
        if (empty(self::$inst)) {
            self::$inst = new static;
        }
        return self::$inst;
    }

    /**
    * True
    */ 
    public function isTrue($value)
    {
        if (true !== $value) {
            throw new AssertException('True expected, '. $this->getType($value) .' given');
        }
        
        return $this;
    }
    
    /**
    * False
    */ 
    public function isFalse($value)
    {
        if (false !== $value) {
            throw new AssertException('False expected, '. $this->getType($value) .' given');
        }
        
        return $this;
    }
    
    /**
    * Булево значение
    */ 
    public function isBoolean($value)
    {
        if (!is_bool($value)) {
            throw new AssertException('Boolean type expected, '. gettype($value) .' given');
        }
        
        return $this;
    }

    /**
    * Целочисленное значение
    */ 
    public function isInteger($value)
    {
        if (!is_integer($value)) {
            throw new AssertException('Integer type expected, '. gettype($value) .' given');
        }
        
        return $this;
    }

    /**
    * Строковое значение
    */ 
    public function isString($value)
    {
        if (!is_string($value)) {
            throw new AssertException('String type expected, '. gettype($value) .' given');
        }
        
        return $this;
    }

    /**
    * Массив
    */ 
    public function isArray($value)
    {
        if (!is_array($value)) {
            throw new AssertException('Array type expected, '. gettype($value) .' given');
        }
        
        return $this;
    }

    /**
    * Объект
    */ 
    public function isObject($value)
    {
        if (!is_object($value)) {
            throw new AssertException('Object type expected, '. gettype($value) .' given');
        }
        
        return $this;
    }
    
    /**
    * Объект
    */ 
    public function isCallable($value)
    {
        if (!is_callable($value)) {
            throw new AssertException('Callable type expected, '. gettype($value) .' given');
        }
        
        return $this;
    }

    /**
    * Сообщение об отсутствии свойства
    */ 
    public function isEmail($value)
    {
        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new AssertException('Email is incorrect');
        }
        
        return $this;
    }
    
    /**
    * Непустое значение
    */ 
    public function notEmpty($value)
    {     
        if (empty($value) && $value !== 0) {
            throw new AssertException('This value is empty');
        }
        
        return $this;
    }
    
    /**
    * Наличие в массиве
    */ 
    public function inArray($needle, $haystack)
    {
        if (!in_array($needle, $haystack)) {
            throw new AssertException('Element `'. $needle .'` not found in array');
        }
        
        return $this;
    }    
    
    /**
    * Наличие ключа в массиве
    */ 
    public function keyInArray($key, $haystack)
    {
        if (!isset($haystack[$key])) {
            throw new AssertException('Element with a key `'. $key .'` is not set in the array');
        }
        
        return $this;
    }   

    /**
    * Сравнение количества элементов массивов
    */ 
    public function sameCount($arr1, $arr2)
    {
        if (count($arr1) !== count($arr2)) {
            throw new AssertException('The number of elements is not the same');
        }
        
        return $this;
    }
    
    /**
    * Проверка наличия метода в классе объекта
    */ 
    public function methodExists($object, $method)
    {
        if (!method_exists($object, $method)) {
            $class = is_object($object) ? get_class($object) : $object;
            throw new AssertException('Method '. $class .'::'. $method .' not defined');
        }
        
        return $this;
    }
    
    /**
    * Сообщение об отсутствии свойства
    */ 
    public function protertyNotFound($name)
    {
        throw new AssertException('Trying to get property of non-object (::'. $name .')');
    }

    
    /**
    * getType
    */ 
    protected function getType($value)
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        
        return gettype($value);
    }  
}