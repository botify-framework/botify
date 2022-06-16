<?php

namespace Jove\Methods\Chats;

use Amp\Promise;

trait GetChatMember
{

    /**
     * @param $chat_id
     * @param $user_id
     * @return Promise
     */
    public function getChatMember($chat_id, $user_id): Promise
    {
        return $this->post(__FUNCTION__, compact(
            'chat_id', 'user_id'
        ));
    }
}