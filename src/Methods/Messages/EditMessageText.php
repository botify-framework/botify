<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use Jove\Types\Map\Message;
use function Amp\call;

trait EditMessageText
{

    public function editMessageText(
        $chat_id,
        $message_id,
        $text,
        $parse_mode = null
    ): Promise
    {
        return call(function () use (
            $chat_id,
            $message_id,
            $text,
            $parse_mode
        ) {
            $response = yield $this->post('editMessageText', compact(
                'chat_id', 'message_id', 'text', 'parse_mode'
            ));

            return new Message($response['result']);
        });
    }
}