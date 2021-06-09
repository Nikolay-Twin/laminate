<?php 
 
namespace core\adapters\yii;

use Yii;
use yii\db\Command;
use yii\db\Query;
use yii\db\Expression;
use core\ports\DbInterface;

/**
 *
 */
class DbAdapter implements DbInterface
{
    
    /**
     * Использование чистых запросов
     *
     * @param string $query
     */
    public function createCommand($query)
    {
        $this->db = Yii::$app->db;
        return $this->db->createCommand($query);     
    }
    
    /**
     * Билдер
     *
     * @param string $query
     */
    public function build()
    {
        return new Query;    
    }
    
    /**
     * Выражения
     *
     * @param string $query
     */
    public function expression($query)
    {
        return Expression($query);    
    }
}
