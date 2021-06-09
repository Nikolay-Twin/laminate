<?php

namespace debug;

use debug\Handler;

/** 
 * Class View
 * Prepares HTML to display debugger report
 * NOTE: Requires PHP version 5.5 or later   
 * @author Nikolay Twin
 * @copyright © 2015
 * @license http://www.wtfpl.net/  
 */   

class View
{    

    /**
    * Returns part of code
    *
    * @param array $data
    *
    * @return string
    */  
    public static function createBlock($data)
    { 
        $data['lines'] = implode('<br>', $data['lines'][0]);
        $data['title'] = self::getTitle();
        return self::parseTpl('block.tpl', $data);
    }     

    /**
    * Returns the result of the trace
    *
    * @param array $data
    *
    * @return string
    */  
    public static function createDbg($data)
    {
        $data['title'] = self::getTitle();
        $data['uniq']  = 'main';
        return self::parseTpl('dbg.tpl', $data);
    }

    /**
    * Returns a listing of the contents of a variable
    *
    * @param array $data
    *
    * @return string
    */  
    public static function createParams($data)
    {
        $data['argLines'] = implode('<br>', $data['argLines']);
        return self::parseTpl('params.tpl', $data);
    } 
    
    /**
    * Returns Editor
    *
    * @param array $data
    *
    * @return string
    */ 
    public static function createEditor($data)
    {
        return self::parseTpl('editor.tpl', [$data]);
    }  

    /**
    * Returns the trace
    *
    * @param array $data
    *
    * @return string
    */ 
    public static function createStack($data)
    {
        $data = array_merge($data, self::getTitle());
        return self::parseTpl('stack.tpl', $data);
    } 
    
    /**
    * Returns  the row of the trace
    *
    * @param array $data
    *
    * @return string
    */     
    public static function createStackRow($data)
    {
        return self::parseTpl('stack_row.tpl', $data);
    } 
    
    /**
    * Returns report
    *
    * @param array $data
    *
    * @return string
    */ 
    public static function createReport($data)
    {
        return self::parseTpl('report.tpl', $data);
    } 
    
    /**
    * Output report
    *
    * @param array $data
    *
    * @return void
    */ 
    public static function display($data)
    {
        exit(self::parseTpl('main.tpl', ['content' => $data]));
    }  
    
    /**
    * Fills the pattern and returns it
    *
    * @param string $tpl
    * @param array $data
    *
    * @return string
    */     
    protected static function parseTpl($tpl, $data)
    {
        extract($data);
        ob_start();       
        include __DIR__ .'/tpl/'. $tpl;
        return ob_get_clean();
    }   
    
    /**
    * Create title array
    *
    * @return array
    */  
    protected static function getTitle()
    {
        $translator = Handler::$translator;
        return  [
                    'arguments'  => $translator::ARGUMENTS,
                    'stack'      => $translator::STACK,
                    'dbg'        => $translator::DBG,
                    'fix'        => $translator::FIX,
                    'editor'     => $translator::EDITOR,
                    'comment'    => $translator::COMMENT,
                    'position'   => $translator::POSITION,
                    'action'     => $translator::АCTION,
                    'file'       => $translator::FILE,
                    'line'       => $translator::LINE,
                ];
    }

}
