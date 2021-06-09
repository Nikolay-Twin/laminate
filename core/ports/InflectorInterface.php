<?php
 
namespace Core\adapters\ports;

/**
* Сотрудник
*/
interface InflectorInterface
{
    /**
     * Converts a word to its plural form.
     */
    public static function pluralize($word);

    /**
     * Returns the singular of the $word.
     */
    public static function singularize($word);

    /**
     * Converts an underscored or CamelCase word into a English
     * sentence.
     */
    public static function titleize($words, $ucAll);

    /**
     * Returns given word as CamelCased.
     */
    public static function camelize($word);
    /**
     * Converts a CamelCase name into space-separated words.
     */
    public static function camel2words($name, $ucwords);
    /**
     * Converts a CamelCase name into an ID in lowercase.
     */
    public static function camel2id($name, $separator, $strict);

    /**
     * Converts an ID into a CamelCase name.
     */
    public static function id2camel($id, $separator);

    /**
     * Converts any "CamelCased" into an "underscored_word".
     */
    public static function underscore($words);

    /**
     * Returns a human-readable string from $word.
     */
    public static function humanize($word, $ucAll);

    /**
     * Same as camelize but first char is in lowercase.
     *
     */
    public static function variablize($word);

    /**
     * Converts a class name to its table name (pluralized) naming conventions.
     *
     */
    public static function tableize($className);

    /**
     * Returns a string with all spaces converted to given replacement,
     * non word characters removed and the rest of characters transliterated.
     */
    public static function slug($string, $replacement, $lowercase);

    /**
     * Returns transliterated version of a string.
     */
    public static function transliterate($string, $transliterator);
}