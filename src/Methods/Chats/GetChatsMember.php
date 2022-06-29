<?php

namespace Jove\Methods\Chats;

use Amp\Promise;
use Jove\Types\Map\ChatMember;
use function Amp\call;

trait GetChatsMember
{

    /**
     * Getting user info in multiple chats
     *
     * @param array $chat_ids
     * @param $user_id
     * @return Promise|ChatMember[]
     */
    protected function getChatsMember(array $chat_ids, $user_id): Promise
    {
        return call(function () use ($chat_ids, $user_id) {
            $promises = [];

            foreach ($chat_ids as $chat_id)
                $promises[$chat_id] = $this->getChatMember(
                    chat_id: $chat_id,
                    user_id: $user_id
                );

            return collect(yield gather($promises));
        });
    }
}