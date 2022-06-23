<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use Jove\Types\Map\Message;
use Jove\Utils\FallbackResponse;
use function Amp\call;

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
        array $extra = []
    ): Promise
    {
        return call(function () use (
            $chat_id,
            $text,
            $parse_mode,
            $extra
        ) {
            $response = yield $this->post('sendMessage', array_merge($extra, compact(
                'chat_id', 'text', 'parse_mode'
            )));

            return isset($response['result'])
                ? new Message($response['result'])
                : new FallbackResponse($response);
        });
    }
}