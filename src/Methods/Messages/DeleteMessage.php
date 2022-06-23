<?php

namespace Jove\Methods\Messages;

use Amp\Promise;

trait DeleteMessage
{
    public function deleteMessage(
        int $chat_id,
        int $message_id
    ): Promise
    {
        return $this->post(__FUNCTION__, compact(
            'chat_id', 'message_id'
        ));
    }
}