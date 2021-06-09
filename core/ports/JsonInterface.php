<?php
 
namespace core\ports;

/**
* Сотрудник
*/
interface JsonInterface
{
    /**
     * Encodes the given value into a JSON string.
     */
    public static function encode($value, $options);

    /**
     * Decodes the given JSON string into a PHP data structure.
     */
    public static function decode($json, $asArray, $exception);
    
    /**
     * Generates a summary of the validation errors.
     */
    public static function errorSummary($models, $options);
}