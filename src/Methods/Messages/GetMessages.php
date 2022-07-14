<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use Jove\Types\Map\Message;
use Jove\Utils\Collection;
use function Amp\call;

trait GetMessages
{

    /**
     * @param $chat_id
     * @param array $ids
     * @return Promise<Collection<?Message>>
     */
    public function getMessages($chat_id, array $ids = []): Promise
    {
        return call(
            fn() => collect(yield gather(array_map(
                fn($id) => $this->getMessage($chat_id, $id),
                $ids
            )))
        );
    }

    /**
     * @param $chat_id
     * @param $message_id
     * @return Promise<?Message>
     */
    protected function getMessage($chat_id, $message_id): Promise
    {
        return call(function () use ($chat_id, $message_id) {
            if ($message = yield $this->redis?->get('messages:' . $chat_id . '.' . $message_id)) {
                return unserialize($message);
            }

            return new Message([]);
        });
    }
}