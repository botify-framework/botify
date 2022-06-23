<?php

namespace Jove\Methods\Chats;

use Amp\Promise;
use Jove\Types\Map\User;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait GetChatMember
{

    /**
     * @param $chat_id
     * @param $user_id
     * @return Promise
     */
    public function getChatMember($chat_id, $user_id): Promise
    {
        return call(function () use (
            $chat_id,
            $user_id
        ) {
            $response = yield $this->post('getChatMember', compact(
                'chat_id', 'user_id'
            ));

            return isset($response['result'])
                ? new User($response['result'])
                : new FallbackResponse($response);
        });
    }
}