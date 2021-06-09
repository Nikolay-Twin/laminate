<?php 

namespace core\system;

use  dic\interfaces\LocatorInterface;
  
use core\system\contracts\{
    CommandInterface,
    ServiceInterface,
    DtoInterface
};

/** 
 * Шина команд 
 */ 
class CommandBus
{
    /**    
    *
    * @param string $group
    */ 
    public function setCommandLocator(LocatorInterface $commandLocator)
    {
        $this->commandLocator = $commandLocator;
        return $this;
    }
    
    /**    
    *
    * @param string $group
    */ 
    public function setServiceLocator(LocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**    
    * Результат в виде DTO
    *
    * @param object $command
    *
    * @return array|object  
    */
    public function execute($command)
    {
        return $this->handle($command)->getResult();
    }
    
    /**    
    * Результат в виде DTO
    *
    * @param object $command
    *
    * @return array|object  
    */
    public function asArray($command)
    {
        return $this->handle($command)->getArray();
    }
    
    /**    
    * Обработчик
    *
    * @param object|string $command
    *
    * @return object  
    */
    protected function handle($command)
    { 
        if(is_string($command)){
            $command = $this->commandLocator->get(CommandInterface::class, $command);
        }
       
        $className = get_class($command);
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $commandName = basename($className);
        $serviceClassName = substr($commandName, 0, -7) .'Service';
        return $this->serviceLocator->get(ServiceInterface::class, $serviceClassName)->run($command);
    }
}
 