<?php

namespace Jove\Methods\Messages;

use Amp\Promise;

trait SendPhoto
{

    public function sendPhoto(
        int $chat_id,
        string $photo,
        string $caption = null,
        string $parse_mode = null
    ): Promise
    {
        return $this->post(__FUNCTION__, compact(
            'chat_id', 'photo', 'caption', 'parse_mode'
        ));
    }
}