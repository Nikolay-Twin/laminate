<?php
 
namespace debug;

/** 
 * Class Fixer
 * 
 * NOTE: Requires PHP version 5.5 or later   
 * @author Nikolay Twin
 * @copyright © 2015
 * @license http://www.wtfpl.net/ 
 * 
 */   
class Fixer
{

    /**
    * Updating file with fixed code
    *
    * @param string $file
    * @param string $code
    *
    * @return bool
    */     
    public static function update($file, $code) 
    {
        if (!file_exists($file)) {
            return false;
        }
      
        if(copy($file, $file .'.bak')) {
            if(file_put_contents($file, $code)) {
                unlink($file .'.bak');
                return true;
            } else {
                if (copy($file .'.bak', $file)) {
                    unlink($file .'.bak');
                }
            }
        }
        
        return false;
    }
}
