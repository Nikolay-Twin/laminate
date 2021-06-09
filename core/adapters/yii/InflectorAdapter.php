<?php

namespace Core\adapters;

use Core\adapters\ports\InflectorInterface;
use yii\helpers\BaseInflector as Inflector;
use yii\base\InvalidArgumentException;

/**
* Внутренняя валидация
*/
class InflectorAdapter implements InflectorInterface
{
    /**
     * Converts a word to its plural form.
     */
    public static function pluralize($word)
    {
        return Inflector::pluralize($word);
    }

    /**
     * Returns the singular of the $word.
     */
    public static function singularize($word)
    {
        return Inflector::singularize($word);
    }

    /**
     * Converts an underscored or CamelCase word into a English
     * sentence.
     */
    public static function titleize($words, $ucAll = false)
    {
        return Inflector::titleize($words, $ucAll);
    }

    /**
     * Returns given word as CamelCased.
     */
    public static function camelize($word)
    {
        return Inflector::camelize($word);
    }

    /**
     * Converts a CamelCase name into space-separated words.
     */
    public static function camel2words($name, $ucwords = true)
    {
        return Inflector::camel2words($name, $ucwords);
    }

    /**
     * Converts a CamelCase name into an ID in lowercase.
     */
    public static function camel2id($name, $separator = '-', $strict = false)
    {
        return Inflector::camel2id($name, $separator, $strict);
    }

    /**
     * Converts an ID into a CamelCase name.
     */
    public static function id2camel($id, $separator = '-')
    {
        return Inflector::id2camel($id, $separator);
    }

    /**
     * Converts any "CamelCased" into an "underscored_word".
     */
    public static function underscore($words)
    {
        return mb_strtolower(preg_replace('/(?<=\\pL)(\\p{Lu})/u', '_\\1', $words), 'UTF-8');
    }

    /**
     * Returns a human-readable string from $word.
     */
    public static function humanize($word, $ucAll = false)
    {
        return Inflector::humanize($word, $ucAll);
    }

    /**
     * Same as camelize but first char is in lowercase.
     *
     */
    public static function variablize($word)
    {
        return Inflector::variablize($word);
    }

    /**
     * Converts a class name to its table name (pluralized) naming conventions.
     *
     */
    public static function tableize($className)
    {
        return Inflector::tableize($className);
    }

    /**
     * Returns a string with all spaces converted to given replacement,
     * non word characters removed and the rest of characters transliterated.
     */
    public static function slug($string, $replacement = '-', $lowercase = true)
    {
        return Inflector::slug($string, $replacement, $lowercase);
    }

    /**
     * Returns transliterated version of a string.
     */
    public static function transliterate($string, $transliterator = null)
    {
        return Inflector::transliterate($string, $transliterator);
    }
}
