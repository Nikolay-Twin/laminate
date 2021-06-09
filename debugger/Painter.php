<?php

namespace debug;

use debug\Config;

/** 
 * Class Highlight
 * Highlights of listings
 *
 * NOTE: Requires PHP version 5.5 or later   
 * @author Nikolay Twin
 * @copyright © 2015
 * @license http://www.wtfpl.net/   
 */   

class Painter
{
    /**
    * Highlighting the path
    *
    * @param string $file
    *
    * @return string
    */  
    public static function highlightPath($file)
    { 
        $path = str_replace('/', 
                            '<span class="separator">/</span>',
                            dirname($file));
        $filename = '<span class="basename">/'. basename($file) .'</span>';                            
        return '<span class="path">'. $path .'</span>'. $filename;
    }
    
    /**
    * Highlighting the line
    *
    * @param string $line
    * @param string $type
    *
    * @return string
    */  
    public static function wrapLine($line, $type)
    {
        return '<span class="'. $type .'_line">'. $line .'</span>';
    }
    
    /**
    * Highlighting php string
    *
    * @param string $string
    *
    * @return string
    */    
    public static function highlightString($string)
    {
        return self::highlight($string);
    }
    
    /**
    * Highlighting php 
    *
    * @param string $code
    * @param string $lang
    *
    * @return string
    */     
    protected static function highlight($code, $lang = 'php')
    { 
        $geshi = new Geshi($code, $lang);
        $geshi->set_code_style(null);
        $geshi->set_header_type(GESHI_HEADER_PRE_TABLE);
        return $geshi->parse_code();
    }
    
    /**
    * Highlighting php listing
    *
    * @param string $blockCont
    * @param int $position
    * @param int $size
    *
    * @return string
    */    
    public static function highlightListing($blockCont, $position, $size)
    {
        $lines = preg_split('~\n~', $blockCont);       
        $lines = array_slice($lines, $position, $size);
        $first = array_shift($lines);
        $check = trim($first);
        
        if (substr($check, 0, 1) === '*' && substr($check, 0, 2) !== '*/') {
            $first = '    /'. $check;
        }
        
        array_unshift($lines, $first);
        return self::highlight(implode("\n", $lines));
    }    
 
    /**
    * Highlighting the value of the arguments 
    *
    * @param string $blockCont
    *
    * @return string
    */    
    public static function highlightDbg($blockCont)
    { 
        return self::highlightVar($blockCont);
    }
 
    /**
    * Highlighting the value of the variable
    *
    * @param string $blockCont
    *
    * @return string
    */    
    public static function highlightVar($blockCont)
    {      
        $strings = ['#(?<!\'|")object\(#i'    => '<span class="type_object">object</span>($1',
                    '#(?<!\'|")array\(#i'     => '<span class="type_array">array</span>($1',
                    '#(?<!\'|")string\(#i'    => '<span class="type_string">string</span>($1',
                    '#(?<!\'|")float\(#i'     => '<span class="type_float">float</span>($1',
                    '#(?<!\'|")int\(#i'       => '<span class="type_int">int</span>($1',
                    '#(?<!\'|")resource\(#i'  => '<span class="type_resource">resource</span>($1',
                    '#(?<!\'|")bool\(#i'      => '<span class="type_bool">bool</span>($1',
                    '#(?<!\'|")null#i'      => '<span class="type_null">NULL</span>$1',
                    
        ];
        
        if (extension_loaded('xdebug')) {
            $blockCont = strip_tags($blockCont);
            $blockCont = preg_replace("~'(.+?)'~i", '<span class="value">\'$1\'</span>', $blockCont);
        } else {
            $blockCont = htmlspecialchars($blockCont, ENT_NOQUOTES);
            $blockCont = preg_replace("~\"(.*?)\"\n~i", "<span class=\"value\">\"$1\"</span>\n", $blockCont);            
            $blockCont = str_replace(['["','"]','":"','":'], ['┠','┥','┊','┇'], $blockCont);
            $blockCont = str_replace(['┠','┥','┊','┇'], ["['","']","':'","':"], $blockCont);
            $blockCont = preg_replace('~\'(.+?)\'~i', '<span class="name">\'$1\'</span>', $blockCont);
        }
        
        $blockCont = preg_replace(array_keys($strings), array_values($strings), $blockCont);     
        $blockCont = preg_replace("~\((.+?)\)~i", '<span class="property">($1)</span>', $blockCont);
        $blockCont = str_replace('*RECURSION*', '<span class="recursion">*RECURSION*</span>', $blockCont);
        $blockCont = str_replace(['ꍴ', 'ꍵ'], ['<span class="argument">', '</span>'], $blockCont);    
         
        
        return $blockCont;
    } 
}

