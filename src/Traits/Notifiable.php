<?php

namespace Botify\Traits;

use Amp\Promise;

trait Notifiable
{
    /**
     * Send a message to current chat
     *
     * @param $text
     * @param ...$args
     * @return Promise
     */
    public function notify($text, ...$args): Promise
    {
        return $this->getAPI()->sendMessage(... $args + [
                'chat_id' => $this->getNotifiableId(),
                'text' => $text,
            ]);
    }

    abstract private function getNotifiableId();
}