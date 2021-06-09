<?php

namespace core\system\contracts;

use dic\interfaces\LocatorInterface;
use Psr\Http\Message\RequestInterface;

/**
 *
 */
interface CommandInterface extends LocatorInterface
{
    public function __construct(RequestInterface $request);
}