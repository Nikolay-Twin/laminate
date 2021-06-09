<?php

namespace core\system;

use core\system\contracts\{
    ServiceInterface,
    CommandInterface,
};
use core\ports\{
    DbInterface
};

use core\adapters\yii\CollectionAdapter;

/**
* Базовый сервис
*/
abstract class Service implements ServiceInterface
{  

    protected $db; 
    
    /**
     * DB
     */
    public function setDb(DbInterface $db)
    {    
        $this->db = $db;
    } 
    
    /**
     * run
     */
    public function run($command)
    {
        $this->process($command);
        return $this;
    } 

    /**
     * DTO
     */
    public function getResult()
    {
        return (new DTO)->make($this);
    }
    
    /**
     * Array
     */
    public function getArray()
    { 
        return json_decode(json_encode($this), true);
    }
}
