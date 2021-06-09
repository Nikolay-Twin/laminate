<?php

namespace core\system\contracts;

/**
 *
 */
interface RepositoryInterface
{
    public function get($id);
    public function add($aggregate)/*: void*/;
    public function save($aggregate); 
    public function remove($aggregate): void;
}