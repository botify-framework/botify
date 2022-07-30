<?php

namespace Botify\Methods\Chats;

use Amp\Promise;
use Botify\Types\Map\ChatMember;
use function Amp\call;
use function Botify\collect;
use function Botify\gather;

trait GetChatsMember
{

    /**
     * Getting user info in multiple chats
     *
     * @param array $chat_ids
     * @param $user_id
     * @return Promise|ChatMember[]
     */
    private function getChatsMember(array $chat_ids, int $user_id): Promise
    {
        return call(function () use ($user_id, $chat_ids) {
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