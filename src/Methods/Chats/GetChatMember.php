<?php

namespace Jove\Methods\Chats;

use Amp\Promise;
use Jove\Types\Map\User;
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
        return call(function () use ($chat_id, $user_id) {
            $response = yield $this->post(__FUNCTION__, compact(
                'chat_id', 'user_id'
            ));

            return new User($response['result']);
        });
    }
}