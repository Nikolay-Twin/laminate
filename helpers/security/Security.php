<?php

namespace Soft\helpers\security;

use Soft\helpers\security\SecurityException;

defined('SVT_LOGIC') or define('SVT_LOGIC', 012301223);

/**
* Пароли
*/
class Security
{

    protected $exception = false;

/**    
* Режим исключения
*/   
    public function exceptionMode()
    {
        $this->exception = true;
        return $this;
    }    
    
/**    
* Метод хэширования пароля
*/   
    public function generatePasswordHash($password)
    {
        return $this->passwordHash($password, SVT_LOGIC);
    }

/**    
* Метод сравнения хэшей
*/   
    public function validatePassword($password, $hash)
    {
        if ($this->passwordHash($password, SVT_LOGIC, $hash) !== $hash) {
            if ($this->exception) {
                throw new SecurityException('Password no valid');
            } 
            
            return false;
        }
        
        return true;
    }

/**    
* Алгоритм хэширования пароля
* @param string $password - хэшируемый пароль
* @param string $logic - алгоритм хэширования
* @param string $hash - соль
* @param int $round - количество раундов хэширования
* @return string
*/   
    protected function passwordHash($password, $logic = 3, $hash = '', $round  = 10)
    {
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789#$%.!-=(){}[]\/';
     
        if(empty($hash)) {                
            $string = str_pad('', 108, $string);
            $string = str_shuffle($string);
            $rand   = round(microtime(true) - floor(microtime(true)), 2) * 100;
            $salt   = substr($string, $rand, 8);
        } else {
             preg_match('~(.*)([a-f0-9]{32})$~ui', $hash, $out);
             
            if(empty($out[1]) && !empty($out[0])) {
                $salt = substr($out[0], 0, 8);
            } else {
                $salt = substr(preg_replace('~[^'. preg_quote($string) .']~ui', 
                                            '-', 
                                            $hash), 
                               0, 8);
            }
        }
     
        $hash = crypt($password, '$1$'. $salt);
     
        $crypt = [ 
                    [CRYPT_MD5,      '$1$'],
                    [CRYPT_BLOWFISH, '$2y$07$'],
                    [CRYPT_SHA256,   '$5$rounds=1000$'],
                    [CRYPT_SHA512,   '$6$rounds=1000$'],
        ];                      
     
        $logic = (string)$logic;
        $cnt   = strlen($logic);
        $round = ($round < 1) ? 1 : $round;
        $round = ($round > 1000) ? 1000 : $round;
     
        while($round--) {
         
            for($i = 0; $i < $cnt; $i++) {
                if(empty($crypt[$logic[$i]][0]) || $crypt[$logic[$i]][0] != 1) {
                    $crypt[$logic[$i]][1] = '$1$';
                }
                preg_match("~[^\$]+$~i", $hash, $out);
                $hash = substr($out[0], 0, 8);
                $hash = crypt($password, $crypt[$logic[$i]][1] . $hash); 
            }
        }
        
        return $salt . md5($hash);   
    }    
}
