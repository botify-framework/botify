<?php

namespace Jove\Methods\Chats;

trait GetChatMembersCount
{

    /**
     * @param $chat_id
     * @return mixed
     */
    public function getChatMembersCount($chat_id)
    {
        return $this->post(__FUNCTION__, compact(
            'chat_id'
        ));
    }
}