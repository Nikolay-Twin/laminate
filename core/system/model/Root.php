<?php

namespace core\system\model;

use core\system\model\Entity;

/** 
 *  Корень
 */ 
class Root extends Entity
{

    private $events = [];
    
    /**
    * @return array
    */  
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    } 
    
    /**
    * @param $event
    */  
    protected function recordEvent($event): void
    {
        $this->events[] = $event;
    }
}
