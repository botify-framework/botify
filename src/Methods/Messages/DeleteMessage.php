<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use function Amp\call;

trait DeleteMessage
{
    public function deleteMessage(
        int $chat_id,
        int $message_id
    ): Promise
    {
        return call(function () use (
            $chat_id,
            $message_id
        ) {
            $response = yield $this->post('deleteMessage', compact(
                'chat_id', 'message_id'
            ));
            #Todo
            return $response['result'];
        });
    }
}