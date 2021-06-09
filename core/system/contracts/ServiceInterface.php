<?php

namespace core\system\contracts;

use core\system\contracts\CommandInterface;

/**
 *
 */
interface ServiceInterface
{
    public function process(CommandInterface $command);
}