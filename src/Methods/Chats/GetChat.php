<?php

namespace Jove\Methods\Chats;

use Amp\Promise;
use Jove\Types\Map\Chat;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait GetChat
{
    /**
     * Getting chat info
     * @param $chat_id
     * @return Promise
     */
    public function getChat($chat_id): Promise
    {
        return call(function () use ($chat_id) {
            $response = yield $this->post('getChat', compact(
                'chat_id'
            ));

            return isset($response['result'])
                ? new Chat($response['result'])
                : new FallbackResponse($response);
        });
    }
}