<?php

namespace App\Exceptions;

use Throwable;

class ImportDoesNotExistException extends \Exception
{
    public function __construct(string $message = "Latest import does not exist", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
