<?php

namespace Jove\Methods\Messages;

use Amp\Promise;

trait SendPhoto
{

    /**
     * @param int $chat_id
     * @param string $photo
     * @param string|null $caption
     * @param string|null $parse_mode
     * @return Promise
     */
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