<?php
    
namespace debug;

use debug\{
    Params,
    Handler
};

/** 
 * Class Dbg
 * Tracing the script.
 * NOTE: Requires PHP version 5.5 or later   
 * @author Nikolay Twin
 * @copyright © 2015 
 * @license http://www.wtfpl.net/  
 */   

class Debugger extends Handler
{

    protected $tracer;
    protected $errorLevel = E_USER_ERROR;
 
    public function __construct($var = 'no arguments')
    {
        parent::__construct();
        $trace = debug_backtrace();
        $this->backTrace = $this->prepareTrace($trace);
        $this->setMessage($var);        
        $this->tracer($var);
        exit;
    }

    /**
    * Choosing a tracers, depending on the type of data
    *
    * @param mixed $var
    *
    * @return void
    */     
    protected function setMessage($var) 
    {
        $translator = Handler::$translator;
     
        if (is_object($var)) {
            $this->message = $translator::TRACING_OBJ .'<br>';        
        } else {
            $this->message = $translator::TRACING_VAR .'<br>';
        }
    }     
 
    /**
    * Starts tracing
    *
    * @param mixed $var
    *
    * @return void
    */      
    protected function tracer($var) 
    {        
        $location = $this->getLocation();
        $params   = Params::getListing($var);
        $listing  = $this->getListingTrace($location, $params);
        $this->create($location, $listing);
    }

    /**
    * Returns the file and the trace line
    *
    * @return string
    */        
    protected function getLocation() 
    { 
        $blocs = [];
     
        foreach ($this->backTrace as $block) {
            $block = $this->normalizeBlock($block);
            if (empty($block)) {continue;}
            $blocs[] = $block;
        }
        
        $location = array_shift($blocs);
        $this->file = $location['file'];
        $this->line = $location['line'];
        array_shift($this->backTrace);
        return $location;
    }
    
    /**
    * Returns generated listing
    *
    * @param string $var
    * @param string $type
    *
    * @return string
    */  
    public function getListingTrace($location, $params) 
    {       
        $data = ['params'     => $params,
                 'fullScript' => file_get_contents($this->file),
                 'position'   => $this->line - 10,
                 'active'     => $this->line,
                 'rawFile'    => str_replace('\\', '/', $location['file']),
        ];
        
        return View::createDbg($data);
    } 
    
    /**
    * Generates a report
    *
    * @param array $location
    * @param string $listing
    *
    * @return void
    */    
    protected function create($location, $listing) 
    { 
        $file = $this->normalisePath($location['file']);
        $file = Painter::highlightPath($file);
     
        $data = [  'message'    => $this->message,
                   'adds'       => true,
                   'level'      => $this->lewelMessage($this->errorLevel),
                   'listing'    => $listing,
                   'file'       => $file,
                   'line'       => $location['line'],                       
                   'stack'      => $this->getStack(),
        ];
        
        $this->action($data);
    }   
}
