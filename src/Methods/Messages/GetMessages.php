<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use function Amp\call;

trait GetMessages
{

    /**
     * @param $chat_id
     * @param int $message_id
     * @return Promise
     */
    public function getMessage($chat_id, int $message_id): Promise
    {
        return call(function () use ($chat_id, $message_id) {
            $responses = yield $this->getMessages($chat_id, $message_id);

            return $responses->first(fn($response) => $response->isSuccess());
        });
    }

    /**
     * @param $chat_id
     * @param $message_ids
     * @return Promise
     */
    public function getMessages($chat_id, $message_ids): Promise
    {
        return call(function () use ($chat_id, $message_ids) {
            $promises = [];

            foreach ((array)$message_ids as $message_id) {
                $promises[] = $this->forwardMessage(
                    chat_id: $this->cacheChat(),
                    from_chat_id: $chat_id,
                    message_id: $message_id,
                );
            }

            return collect(yield gather($promises))
                ->where(fn($response) => $response->isSuccess());

        });
    }

    /**
     * @return array|\Jove\Utils\Config|mixed|void
     * @throws \Exception
     * @internal
     */
    private function cacheChat()
    {
        if ($chatId = config('telegram.cache_chat')) {
            return $chatId;
        }

        throw new \Exception('For getting messages info, You must provide a cache chat');
    }
}