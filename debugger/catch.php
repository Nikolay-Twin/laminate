<?php 


use debug\types\{
    NoFatal,
    Fatal
};

use debug\{    
    Debugger,
    Fixer,
    Handler,
    Linkage,    
    Shutdown
};

    ob_start();
    defined('SVT_DEBUG') or define('SVT_DEBUG', false);

    if (true === SVT_DEBUG) {
     
        error_reporting(-1);
        ini_set('display_errors', 1);
     
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            if (isset($_POST['debuga1b01e734b'])) {
             
                switch(true)
                {
                    case empty($_POST['filea1b01e734b']) :
                    case empty($_POST['codea1b01e734b']) :    
                        exit('dataa1b01e734b');
                    case !Fixer::update($_POST['filea1b01e734b'], $_POST['codea1b01e734b']) :
                        exit('filea1b01e734b');
                    default : 
                        exit('oka1b01e734b');
                }        
            }
         
            Fixer::update($file, $code);
        }
       
        if (isset($_GET['stylea1b01e734b'])) {
            header('Cache-control: public, max-age=14400');
            header('Content-Type: text/css');
            exit(Linkage::style()); 
        }
     
        if (isset($_GET['scripta1b01e734b'])) {
            header('Cache-control: public, max-age=14400');
            header('Content-Type: text/javascript');
            exit(Linkage::script()); 
        }
        
        $handler = new Handler;
        set_exception_handler([$handler, 'exceptionHandler']);
        set_error_handler([$handler, 'triggerErrorHandler']);
        register_shutdown_function([new Shutdown, 'errorHandler']);
      
        if (!function_exists('dbg')) {
         
            function dbg(...$var)
            {
                $var = $var ?: 'no arguments';
                new Debugger($var);
            }
            
        } else {
            throw new BadFunctionCallException('Cannot redeclare dbg(). It function alredy exists.');
        }
    }
   