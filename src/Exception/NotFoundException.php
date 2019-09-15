<?php

namespace Happysir\Respostitory\Exception;

/**
 * Class NotFoundException
 */
class NotFoundException extends RespositoryBaseException
{
    protected $message = 'entity records is not found';
}
