<?php

namespace Jove\Methods\Chats;

use Amp\Promise;
use Generator;
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
        return $this->post('getChat', compact(
            'chat_id'
        ));
    }
}