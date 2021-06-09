<?php

namespace core\system\contracts;

/**
 *
 */
interface IdGeneratorInterface
{
    public function nextId();
    public function uud4();
}