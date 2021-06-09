<?php

namespace core\adapters\yii;

use core\ports\JsonInterface;
use yii\helpers\BaseJson as Json;
use yii\base\InvalidArgumentException;

/**
* Внутренняя валидация
*/
class JsonAdapter implements JsonInterface
{
    /**
     * Encodes the given value into a JSON string.
     */
    public static function encode($value, $options = 320)
    {
        return Json::encode($value, $options);
    }

    /**
     * Decodes the given JSON string into a PHP data structure.
     */
    public static function decode($json, $asArray = true, $exception = true)
    {
        try {
            $decode = Json::decode($json, $asArray);
        } catch (InvalidArgumentException $e) {
         
            if ($exception) {
                throw new \InvalidArgumentException('JSON: '. $e->getMessage());
            } 
            
            return false;
        }
        
        return $decode;
    }
    
    /**
     * Generates a summary of the validation errors.
     */
    public static function errorSummary($models, $options = [])
    {
        return Json::errorSummary($models, $options);
    }
}
