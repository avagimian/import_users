<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class SavingErrorException extends Exception
{
    public function __construct(string $message = "Saving Error", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
