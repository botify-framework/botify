<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use function Amp\call;

trait SendMessage
{
    /**
     * @param $chat_id
     * @param $text
     * @return Promise
     */
    public function sendMessage(
        $chat_id,
        $text,
        $parse_mode = null,
    ): Promise
    {
        return $this->post('sendMessage', compact(
            'chat_id', 'text', 'parse_mode'
        ));
    }
}