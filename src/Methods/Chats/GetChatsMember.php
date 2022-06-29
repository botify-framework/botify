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
    private function getChatsMember(...$args): Promise
    {
        return call(function () use ($args) {
            $args = isset($args[0])
                ? array_merge(array_shift($args), $args)
                : $args;

            $promises = [];

            foreach ($args['chat_ids'] as $chat_id)
                $promises[$chat_id] = $this->getChatMember(
                    chat_id: $chat_id,
                    user_id: $args['user_id']
                );

            return collect(yield gather($promises));
        });
    }
}