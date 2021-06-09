<?php
 
namespace debug;

use debug\{
    Config,
    Painter,
    View, 
    Shutdown
};

 
/** 
 * Class Handler
 * 
 * NOTE: Requires PHP version 5.5 or later   
 * @author Nikolay Twin
 * @copyright © 2015
 * @license http://www.wtfpl.net/ 
 * 
 */   
class Handler
{
    public static $translator;

    protected $sizeListing = 20;
    protected $message;    
    protected $file;  
    protected $line;
    protected $called = 'PHP';
    protected $code;
    protected $num = 0;
    protected $mainBlock = true;
    protected $E_Lavel = [
                E_STRICT,
                E_USER_NOTICE,
                E_USER_WARNING,
                E_USER_ERROR
            ];
            
    /**
    * construct
    */     
    public function __construct() 
    {
        self::$translator = __NAMESPACE__ .'\lang\\'. Config::LANGUAGE;
    }
    
    /**
    * Catch exceptions
    *
    * @return void
    */   
    public function exceptionHandler($e) 
    {
        $this->message = $e->getMessage();
        $this->code    = $e->getCode();     
     
        if ($e instanceof \Error || $e instanceof \ParseError) {
            $this->backTrace = '';
            $file = $e->getFile();
            $line = $e->getLine();
            $this->createFatalReport($file, $line);            
        } else {
            $trace = $e->getTrace();
            $this->backTrace = $this->prepareTrace($trace); 
            $this->createReport();            
        } 
    }
    
    /**
    * Catch trigger_error
    *
    * @return void
    */   
    public function triggerErrorHandler($code, $message, $file, $line) 
    {
        if (error_reporting() & $code) {
            $this->message = $message;
            $this->code = $code; 
            $this->file = $file;
            $this->line = $line; 
            $trace = debug_backtrace();
         
            if (in_array($code, $this->E_Lavel)) {
                array_shift($trace);            
            }
         
            $this->backTrace = $this->prepareTrace($trace);
            $this->createReport();          
        } 
    }
    
    /**
    * Action
    *
    * @return void
    */   
    public function action($data) 
    {      
        $data['num'] = $this->num;
        $debugReport = View::createReport($data);
        Shutdown::add($debugReport);
    }

    /**
    * Prepare a message about the type of error
    *
    * @param int $level
    *    
    * @return string
    */       
    protected function lewelMessage($level) 
    {
        $listLevels = [
                        E_NOTICE        => 'PHP Notice: ',
                        E_WARNING       => 'PHP Warning: ',
                        E_STRICT        => 'PHP Strict: ',
                        E_ERROR         => 'PHP Fatal error: ',
                        E_COMPILE_ERROR => 'PHP Compile error: ',
                        E_CORE_ERROR    => 'PHP Code error: ',
                        E_PARSE         => 'PHP Parse error: ',
                        E_USER_NOTICE   => 'User Notice: ',
                        E_USER_WARNING  => 'User Warning: ',
                        E_USER_ERROR    => 'SVT Message: '                        
        ];
     
        return !empty($listLevels[$level]) ? $listLevels[$level] : 'SVT debug mode: ';
    } 
 
    /**
    * Prepares trace for the exceptions
    *
    * @param array $trace
    *
    * @return void
    */   
    protected function prepareTrace($trace)
    {      
        $j = 0;
        $blocks = [];
        foreach ($trace as $block) {
         
            if (empty($block['class'])) {
                $block['class'] = '{main}';
                $block['type']  = '>>>';
                $this->file = @$block['file'];
                $this->line = @$block['line'];
            }
         
            $beforeClass = @$trace[$j + 1]['class'];   
            $j++;
            $block = $this->blocksFilter($block, $beforeClass);
            
            if (empty($block)) {
                continue;
            }
            
            $blocks[] = $block;
        }
        
        return $blocks;
    }
    
    /**
    * Filters trace
    *
    * @param array $block
    * @param string $beforeClass
    *
    * @return array|bool
    */    
    protected function blocksFilter($block, $beforeClass = '')
    { 
        switch (true) {
         
            case basename($block['class']) === 'Debugger' :
                return false;
         
            case Config::FULL_TRACE :
                return $block;
           
            case empty($block['file']) :
            case !empty($block['file'][1]) && false !== strpos($block['file'], 'eval') :
            case !empty($block['args'][1]) && is_int($block['args'][1]) && in_array($block['args'][1], $this->E_Lavel) :
            case $block['function'] === 'trigger_error' :
            case (false !== strpos($block['function'], '{closure}')) :
            case $this->checkFramework($beforeClass) :            
                return false;
        }    
        
        return $block;
    } 
    
    /**
    * Prepares report
    *
    * @return void
    */   
    protected function createReport() 
    {
        $translator = self::$translator;
        $this->message = $translator::translate($this->message);
        $level   = $this->lewelMessage($this->code);
        $listing = $this->getListing();
        $file = $this->normalisePath($this->file);
        $file = Painter::highlightPath($file);        
     
        $data = [  'message'  => $this->message,
                   'adds'     => isset($this->line),
                   'level'    => $level,
                   'listing'  => $listing,
                   'file'     => $file,                           
                   'line'     => $this->line,                       
                   'stack'    => $this->getStack(),
        ];
     
        $this->action($data);
    }  

    /**
    * Prepares fatal report
    *
    * @param string $file
    * @param int $line
    *
    * @return void
    */   
    protected function createFatalReport($file, $line) 
    {
        $translator = self::$translator;
        $message = $translator::translate($this->message);
        
        $block = ['file'  => $file,
                  'line'  => $line,
                  'fatal' => true,
                  ];
     
        $data = [  'message'  => $message,
                   'adds'     => true,
                   'level'    => $this->lewelMessage($this->code),
                   'listing'  => $this->prepareBlock($block),                       
                   'file'     => $file,
                   'line'     => $line,                       
                   'stack'    => '',
        ];
     
        $this->action($data);
    }    

    /**
    * Generates code section listing
    *
    * @param array $block
    * @param string $uniq
    * @param int $num
    *
    * @return string
    */   
    protected function prepareBlock($block, $uniq = 'main', $num = false) 
    {  
        $active = $i = 0;
        $blockCont = ''; 
     
        if (!empty($block['file'])) {
            $this->file  = $block['file'];
            $this->line  = $block['line'];
            $script = file($block['file']);        
        } elseif(!empty($block['function'])) {
            $script = file($this->file);
            $this->line = $this->getLine($script, $block['function']); 
        }
     
        $ext = ceil($this->sizeListing / 2);
        $position = ($this->line <= $ext) ? 0 : $this->line - $ext;
        
        foreach ($script as $string) {
            ++$i;
         
            if($this->mainBlock && $i == $this->line) {
                $lines[] = Painter::wrapLine($i, 'error');
                $active  = $i;
            } elseif($i == $this->line) {
                $lines[] = Painter::wrapLine($i, 'trace');
                $this->called = Painter::highlightString(trim($string));
            } else {
                $lines[] = $i;
            }
            
            $blockCont .= $string;
        } 
       
        $lines  = array_slice($lines, $position, $this->sizeListing);
        $total  = Painter::highlightListing($blockCont, $position, $this->sizeListing);
        $fullScript = htmlspecialchars(implode($script));
        
        $data = ['fatal'       => @$block['fatal'],
                 'num'         => $num,
                 'lines'       => [$lines],
                 'total'       => $total,
                 'uniq'        => $uniq,
                 'fullScript'  => $fullScript,
                 'position'    => $position,
                 'active'      => $this->line,
                 'rawFile'     => str_replace('\\', '/', $this->file),
                 'params'      => Params::getListing(@$block['args'])
        ];
             
        return View::createBlock($data);
    } 

    /**
    * Normalizes blocks
    *
    * @param string $block
    *
    * @return string
    */    
    protected function normalizeBlock($block)
    {
        if ($block['function'] === 'triggerErrorHandler') {
            $block['file'] = $this->file;
            $block['line'] = $this->line;        
        }
        
        return $this->blocksFilter($block);
    } 
 
    /**
    * Returns the current line
    *
    * @param array $script
    * @param string $function
    *
    * @return int
    */   
    protected function getLine($script, $function) 
    {
        $line = 1;    
        foreach ($script as $string) {
            if (false !== strpos($string, $function)) {
                return $line;
            }
            ++$line;
        }
    }

    /**
    * Returns the main piece of code block
    *
    * @return string
    */   
    protected function getListing() 
    { 
        $block = array_shift($this->backTrace);   
        return $this->prepareBlock($block, 'main');
    }
    
    /**
    * Returns the trace
    *
    * @return string
    */    
    protected function getStack() 
    { 
        $this->mainBlock = false;    
        return $this->prepareStack(); 
    } 
    
    /**
    * Generates a trace table
    *
    * @return string
    */   
    protected function prepareStack()
    {    
        $i = 0;
        $rows = [];
        $stack_uniq = ['main'];
        
        foreach ($this->backTrace as $block) {
         
            $class  = str_replace('\\', DIRECTORY_SEPARATOR, $block['class']);
            $space  = str_replace(DIRECTORY_SEPARATOR, '\\', dirname($class));
            $space  = str_replace('.', '\\', $space);
            $location = basename($this->file);
            $file   = $this->normalisePath(@$block['file']);
            $file   = Painter::highlightPath($file);
            $stack_uniq[] = $uniq = md5(microtime(true));
            $total  = $this->prepareBlock($block, $uniq, ++$i);
            $action = basename($class) .'<span class="act">'. $block['type'] .'</span>'; 
            
            $data = ['space'     => $space,
                     'location'  => $location,
                     'file'      => @$file ?: 'PHP',
                     'line'      => @$block['line'] ?: $this->line,
                     'total'     => $total,
                     'called'    => $this->called,
                     'action'    => $action . $block['function'],
                     'num'       => ++$this->num,
                     'uniq'      => $uniq,
            ];            
          
            $rows[] = View::createStackRow($data);
        }
        
        $data = ['cnt'   => $this->num,
                 'rows'  => implode('', $rows),
                 'uniqs' => json_encode($stack_uniq)
        ];
        
        return View::createStack($data);
    }

    /**
    * Normalise path
    *
    * @param string $path
    *
    * @return string
    */     
    protected function normalisePath($file) 
    {
        $file = @$file ?: $this->file;
        $stack = explode(DIRECTORY_SEPARATOR, $file);
        return '/'. implode('/', array_slice($stack, Config::ROOT_LEVEL));
    }

    /**
    * Recognizes framework classes
    *
    * @param string $beforeClass
    *
    * @return bool
    */    
    protected function checkFramework($beforeClass)
    {   
        if (empty($beforeClass)) {
            return false;
        }
        
        $framework = preg_quote(Config::FRAMEWORK, '~');
        return preg_match('~^'. $framework .'.*~iu', $beforeClass);
    }    
}

