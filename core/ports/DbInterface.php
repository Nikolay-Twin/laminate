<?php

namespace core\ports; 

interface DbInterface
{
    /**
     * Использование чистых запросов
     *
     * @param string $query
     */
    public function createCommand($query);
    
    /**
     * Билдер
     *
     * @param string $query
     */
    public function build();
    
    /**
     * Выражения
     *
     * @param string $query
     */
    public function expression($query);
}