<?php

namespace Jove\Methods\Messages;

use Amp\Promise;

trait SendMessage
{
    /**
     * @param $chat_id
     * @param $text
     * @param null $parse_mode
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