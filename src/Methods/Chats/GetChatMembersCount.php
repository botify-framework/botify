<?php

namespace Jove\Methods\Chats;

use Amp\Promise;
use function Amp\call;

trait GetChatMembersCount
{

    /**
     * @param $chat_id
     * @return Promise
     */
    public function getChatMembersCount($chat_id): Promise
    {
        return call(function () use ($chat_id) {
            $response = yield $this->post('getChatMembersCount', compact(
                'chat_id'
            ));

            return $response['result'] ?? false;
        });
    }
}