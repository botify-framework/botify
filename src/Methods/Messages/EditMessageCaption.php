<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use Jove\Types\Map\Message;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait EditMessageCaption
{

    /**
     * Edit the media message caption
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @param string $text
     * @param string|null $parse_mode
     * @return Promise
     */
    public function editMessageCaption(
        int|string $chat_id,
        int        $message_id,
        string     $caption,
        string     $parse_mode = null,
    ): Promise
    {
        return call(function () use (
            $chat_id,
            $message_id,
            $caption,
            $parse_mode
        ) {
            $response = yield $this->post('editMessageCaption', compact(
                'chat_id', 'message_id', 'caption', 'parse_mode'
            ));

            return isset($response['result'])
                ? new Message($response['result'])
                : new FallbackResponse($response);
        });
    }
}