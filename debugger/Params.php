<?php
    
namespace debug;

use debug\{
    Painter,
    View
};

/** 
 * Class Params
 * 
 * NOTE: Requires PHP version 5.5 or later   
 * @author Nikolay Twin
 * @copyright © 2015 
 * @license http://www.wtfpl.net/  
 */   

class Params
{
    /**
    * Returns generated listing
    *
    * @param string $var
    *
    * @return string
    */  
    public static function getListing($var) 
    {
        $value = self::prepare($var);
        $data['total'] = Painter::highlightVar($value);
        $data['argLines'] = self::createLine($value);
        return View::createParams($data);
    }      

    /**
    * Preparing data for listings
    *
    * @param string $value
    *
    * @return string
    */     
    protected static function prepare($value = null) 
    {
        $i = 0;
        $args = [];
        foreach ($value as $arg) {
            $args[] = 'ꍴ$arg'. (++$i) .' = ꍵ' . trim(self::prepareVar($arg)) ."\n\n";
        }
     
        return "\n". implode($args);
    }

    /**
    * Preparing data for listings
    *
    * @param string $value
    *
    * @return string
    */     
    protected static function prepareVar($value = null) 
    {
        if ($value === null) {
            $value = 'Void';  
        } else { 
            ob_start();
                var_dump($value);
            $value = ob_get_clean();
        }
        
        return $value;
    }     
    
    /**
    * Generate arrays column numbering lines
    *
    * @param string|array $var
    *
    * @return array
    */     
    protected static function createLine($var) 
    {          
        return range(1, substr_count((string)$var, "\n") + 3);
    }  
}
