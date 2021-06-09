<?php 

namespace core\system;

use core\adapters\;
use core\system\{
    LazyLoad,
    Entity,
    exceptions\RepositoryException
};
use core\adapters\yii\{
    DbAdapter,
    JsonAdapter as Json;
    InflectorAdapter as Inflector
};

/**
* Базовый репозиторий
*/
class Repository extends DbAdapter 
{
    protected $table;

    /**
    * Добавляет в репозиторий новую инстанцию 
    */ 
    public function addAgregate($id, $data)
    {     
        try {
            $this->createCommand()
                ->insert("{{". $this->getTable() ."}}", $data)
                ->execute();
         
        } catch (\PDOException $e) {
            throw new RepositoryException("Failure to add the aggregate  
                                          (". $e->getMessage() .")",
                                          RepositoryException::FAILED_ADD);
        }
    } 

    /**
    * Возвращает объект по идентификатору
    */ 
    public function getAgregate($id, $class)
    {
        try {
         
            $this->createCommand("SET AUTOCOMMIT=0")
                     ->execute();
         
            $data = $this->createCommand("SELECT *
                                                FROM {{". $this->getTable() ."}}
                                                 WHERE [[id]] = ". (int)$id ."
                                                 FOR UPDATE"
                            )->queryOne();
         
        } catch (\PDOException $e) {   
            throw new RepositoryException('Failure to save the aggregate \"'
                                        . basename($class) ."\n (". $e->getMessage() .')',
                                          RepositoryException::FAILED_GET);
        }
        
        if (empty($data)) {
            throw new RepositoryException('The '. basename($class) .' aggregate with ID = '
                                                . ($id ?: 'null') .' was not found',
                                          RepositoryException::NOT_FOUND);
        }
        
        $data = $this->extractResult($data);
        return Hydrator::fill($class, $data);
    }
    
    /**
    * Сохранение измененного объекта
    */ 
    public function saveAgregate($id, $data)
    {
        try {
         
            $res = $this->createCommand()
                     ->update("{{". $this->getTable() ."}}", $data, ['id' => $id])
                     ->execute();
         
            $this->createCommand("COMMIT")
                     ->execute();

            $this->createCommand("SET AUTOCOMMIT=1")
                ->execute();
            
        } catch (\PDOException $e) {
            $target = basename(get_class($aggregate));
            throw new RepositoryException('Failure to save the aggregate \"'
                                        . $target ."\n (". $e->getMessage() .')',
                                          RepositoryException::FAILED_SAVE);
        }
        
        return true;
    }
    
    /**
    * Удаление объекта
    */ 
    public function removeAgregate($aggregate)
    {
        $id = $aggregate->getId();
        $properties = Hydrator::getObjectVars($aggregate);
        $entity = Entity::class;
        
        try {        
            foreach ($properties as $name => $value) {
             
                if (is_object($value) && $value instanceof $entity) {
                    $table = Inflector::underscore($name);
                    $this->createCommand()
                             ->delete("{{". $this->context .'_'. $table ."}}", ['id' => $value->getId()])
                             ->execute();    
                }
            }
         
            $this->createCommand()
                     ->delete("{{". $this->getTable() ."}}", ['id' => $id])
                     ->execute();
         
            $this->createCommand("COMMIT")
                     ->execute();
            
        } catch (\PDOException $e) {
            $target = basename(get_class($aggregate));
            throw new RepositoryException('Failure to remove the aggregate \"'
                                        . $target ."\n (". $e->getMessage() .')',
                                          RepositoryException::FAILED_REMOVE);
        }
        
        return $id;
    }

    /**
    * Разбирает объект в подготовленный массив для чтения 
    */ 
    protected function extractResult($data)
    {
        $prepareData = [];    
        foreach($data as $name => $value) {
            $prepareData[$name] = $this->prepareReadData($name, $value);
        }
        
        return $prepareData;
    } 
    
    /**
    * Ленивая запись сущностей 
    */     
    protected function saveEntity($entity)
    { 
        $id = $entity->getId();
        $name = basename(get_class($entity));
        $modified = array_change_key_case(static::$modified);
     
        if(isset($modified[strtolower($name)])) {
            $extract = 'extract'. $name .'Data';    
            $data = $this->$extract($entity);
            $name = Inflector::underscore($name);
            $bindData   = $this->prepareBindData($data);
            $insertData = $this->prepareWriteData($data);
            array_shift($data);
            $updateData = $this->prepareWriteData($data);;
            $this->createCommand("INSERT INTO {{". $this->context ."_". $name ."}}
                                      SET  ". implode(",\n", $insertData) ."
                                      ON DUPLICATE KEY UPDATE "
                                        . implode(",\n", $updateData) 
                                    )->bindValues($bindData)
                                     ->execute();
                                     
        }
        
        return $id;
    }      

    /**
    * Распознает и преобразует данные в объекты с ленивой загрузкой  
    */     
    private function prepareReadData($name, $value)
    { 
        $data = Json::decode($value, true, false);
        $class = $this->namespace .'\\'. ucfirst($name);
      
        if(false !== $data && is_array($data)) {
            return Hydrator::fill($class, $data);
        }
        
        if(class_exists($class)) {
         
            $value = new LazyLoad(function () use ($class, $name, $value) {
                static::$modified[$name] = true;
                $name = Inflector::underscore($name);
                try {
                    $data = $this->createCommand("SELECT * FROM {{". $this->context ."_". $name ."}}
                                                       WHERE [[id]] = :id
                                                       FOR UPDATE")
                                     ->bindValue(':id', $value)
                                     ->queryOne();
                } catch (\PDOException $e) {
                    throw new RepositoryException('Failure to get "'. basename($class) 
                                                ."\n (". $e->getMessage() .')',
                                                RepositoryException::FAILED_GET);
                }
                
                if (empty($data)) {
                    throw new RepositoryException('The entity '. basename($class) 
                                              .' with ID = '. ($value ?: 'null') .' was not found',
                                                RepositoryException::NOT_FOUND);
                }
                
                return Hydrator::fill($class, $data);
            });    
        }
        
        return $value;
    } 
    
    /**
    *  Подготавливает данные для записи
    */     
    private function prepareWriteData($data)
    { 
        $prepareData = [];    
        foreach($data as $name => $v) {
            $prepareData[] = '[['. $name .']]=:'. $name;
        }
        
        return $prepareData;
    }     
    
    /**
    *  Подготавливает данные для биндинга
    */     
    private function prepareBindData($data)
    { 
        $prepareData = [];    
        foreach($data as $name => $value) {
            $prepareData[':'. $name] = $value;
        }
        
        return $prepareData;
    } 
    
    /**
    * Формирует имя таблицы БД 
    */  
    private function getTable()
    {
        if (empty($this->table)) {
            $class = str_replace('\\', DIRECTORY_SEPARATOR, get_called_class());
            $class = basename($class);
            $tableName = strtolower(substr($class, 0, -10));
            $tableName = Inflector::underscore($tableName);
            $this->table = $this->context .'_'. $tableName;        
        }
     
        return $this->table;
    }
}
