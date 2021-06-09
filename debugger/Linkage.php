<?php

namespace debug;

use debug\Config;

class Linkage
{
    public static function style()
    {
        $debugger   = file_get_contents(__DIR__ .'/theme/'. Config::THEME .'/debugger.css'); 
        $codemirror = file_get_contents(__DIR__ .'/theme/'. Config::THEME .'/codemirror.css');
        return $debugger ."\n\n". $codemirror;
        
    }

    public static function script()
    {
        $ajax          = file_get_contents(__DIR__ .'/assets/ajax.js');
        $debugger      = file_get_contents(__DIR__ .'/assets/debugger.js');
        $codemirror    = file_get_contents(__DIR__ .'/assets/codemirror/codemirror.js'); 
        $matchbrackets = file_get_contents(__DIR__ .'/assets/codemirror/matchbrackets.js'); 
        $htmlmixed     = file_get_contents(__DIR__ .'/assets/codemirror/htmlmixed.js'); 
        $xml           = file_get_contents(__DIR__ .'/assets/codemirror/xml.js'); 
        $javascript    = file_get_contents(__DIR__ .'/assets/codemirror/javascript.js'); 
        $css           = file_get_contents(__DIR__ .'/assets/codemirror/css.js'); 
        $clike         = file_get_contents(__DIR__ .'/assets/codemirror/clike.js'); 
        $php           = file_get_contents(__DIR__ .'/assets/codemirror/php.js'); 
        
        return  $ajax ."\n\n"
             . $debugger."\n\n"
             . $codemirror ."\n\n"
             . $matchbrackets ."\n\n"
             . $htmlmixed ."\n\n"
             . $xml ."\n\n"
             . $javascript ."\n\n"
             . $css ."\n\n"
             . $clike ."\n\n"
             . $php;
        
    }    
    
}

 

