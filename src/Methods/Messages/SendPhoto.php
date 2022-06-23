<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use Jove\Types\Map\Message;
use function Amp\call;

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
        return call(function () use ($chat_id, $photo, $caption, $parse_mode) {
            $response = yield $this->post('sendPhoto', compact(
                'chat_id', 'photo', 'caption', 'parse_mode'
            ));

            return new Message($response['result']);
        });
    }
}