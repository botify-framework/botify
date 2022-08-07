<?php

namespace Botify\Exceptions;

use Exception;
use Throwable;

class RetryException extends Exception
{
    public function __construct(protected int $retryAfter, string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getRetryAfter(): int
    {
        return $this->retryAfter;
    }
}