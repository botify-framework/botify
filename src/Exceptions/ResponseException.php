<?php

namespace Jove\Exceptions;

use Exception;

class ResponseException extends Exception
{
    public int $retryAfter = 0;

    public mixed $migrateToChatId = null;

    public function __construct(array $result)
    {
        if (isset($result['retry_after']))
            $this->retryAfter = $result['retry_after'];

        if (isset($result['migrate_to_chat_id']))
            $this->migrateToChatId = $result['migrate_to_chat_id'];

        $errorCode = $result['error_code'] ?? 0;
        $message = $result['description'] ?? sprintf('[%d] Unsuccessful request', $errorCode);

        parent::__construct($message, $errorCode);
    }
}