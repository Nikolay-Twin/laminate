<?php

namespace debug;

use debug\Handler;

/** 
 * Class Fatal
 * 
 * NOTE: Requires PHP version 5.5 or later   
 * @author Nikolay Twin
 * @copyright © 2015
 * @license http://www.wtfpl.net/ 
 * 
 */   
class Shutdown extends Handler
{

    protected static $report;

    /**
    * Add report
    *
    * @param string $report
    *
    * @return void
    */   
    public static function add($report) 
    {       
        self::$report = $report;
    }
    
    /**
    * Catch fatal error
    *
    * @return void
    */   
    public function errorHandler() 
    {
        parent::__construct(); 
        
        if (!empty(self::$report)) {
            ob_end_clean();
            View::display(self::$report);
        }
        
        if ($error = error_get_last() AND $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
         
            ob_end_clean();
            $this->message = $error['message'];
            $this->code = $error['type']; 
            $file = $error['file'];
            $line = $error['line'];
            $this->createFatalReport($file, $line); 
            View::display(self::$report);
        } else {
            @ob_flush();
        }
    } 
}