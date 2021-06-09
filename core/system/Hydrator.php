<?php

namespace core\system;

/** 
 *  Hydrator
 */ 
class Hydrator 
{
    protected static $reflectClassMap;
    
    /** 
     * Инициализация в обход конструктора
     */ 
    public static function instance($class, array $args = [])
    {
        $reflection = self::getReflectionClass($class);
        $target = $reflection->newInstanceWithoutConstructor();
           
        if (!empty($args)) {
            $method = $reflection->getMethod('create');
            $method->setAccessible(true);    
            $method->invokeArgs($target, $args);
        }
        
        return $target;
    }   
    
    /** 
     *  Заполняет объект данными
     */  
    public static function fill($class, array $data)
    {
        $reflection = self::getReflectionClass($class);
        $target = $reflection->newInstanceWithoutConstructor();
        
        foreach ($data as $name => $value) {
            $property = $reflection->getProperty($name);
            
            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }
            
            $property->setValue($target, $value);
        }
        
        return $target;
    }
    
    /** 
     *  Получает данныые приватных и защищенных свойств
     */  
    public static function extract($object, array $fields = [])
    {
        $result = [];
        $reflection = self::getReflectionClass(get_class($object));
        
        foreach ($fields as $name) {
            $property = $reflection->getProperty($name);
            
            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }
            
            $result[$property->getName()] = $property->getValue($object);
        }
        
        return $result;
    }
    

    public static function getObjectVars($object)
    {
        $result = [];
        $reflection = self::getReflectionClass(get_class($object));
        $properties = $reflection->getProperties();
        foreach($properties as $obj) {
            $property = $reflection->getProperty($obj->name);
            $property->setAccessible(true);
            $result[$obj->name] = $property->getValue($object);
        }
        return $result;
    } 
    
    /** 
     *  Получаем рефлексию
     */  
    protected static function getReflectionClass($className)
    {
        if (!isset(self::$reflectClassMap[$className])) {
            self::$reflectClassMap[$className] = new \ReflectionClass($className);
        }
        return self::$reflectClassMap[$className];
    }
}
