<?php

namespace Debug\Lang;


/** 
 * Класс En
 * 
 * NOTE: Requires PHP version 5.5 or later   
 * @author phpforum.su
 * @copyright © 2015
 * @license http://www.wtfpl.net/ 
 */   
class En
{
    const АCTION        = 'Location -> action';
    const FILE          = 'File';
    const LINE          = 'in line';
    const CALLED        = 'Called out';
    const ARGUMENTS     = 'Arguments';
    const STACK         = 'Stack'; 
    const TRACING_VAR   = 'Tracing Variable';
    const TRACING_VAR   = 'Tracing Object';
    const COMMENT       = 'Comment out';
    const POSITION      = 'To position';
    
    protected static function errorReportings() 
    {
        return [];
    }

    public static function translate($message) 
    {
        return $message;
    }

    protected static function errorReportingsSql() 
    {
        return [];
    }

    public static function translateSql($message) 
    {
        return $message;
    }    
    
}
