<?php

namespace Jove\Methods\Messages;

use Amp\Producer;
use Amp\Promise;
use Jove\Types\Map\Message;
use Jove\Utils\Collection;
use function Amp\call;

trait GetMessages
{

    /**
     * @param int $chat_id
     * @param ?callable $filter
     * @return Producer
     */
    protected function getHistory(int $chat_id, callable $filter = null): Producer
    {
        return new Producer(function ($emit) use ($chat_id, $filter) {
            $keys = yield $this->redis?->getKeys('messages:' . $chat_id . '.*');

            yield gather(array_map(
                fn($key) => call(function () use ($key, $emit, $filter) {
                    if ($data = json_decode(yield $this->redis?->get($key), true)) {
                        if ($message = new Message($data)) {
                            if (is_callable($filter)) {
                                if ($filter($message)) {
                                    return yield $emit($message);
                                }
                            } else {
                                yield $emit($message);
                            }
                        } else {
                            yield $emit(new Message());
                        }
                    }
                }), $keys ?? []
            ));
        });
    }

    /**
     * @param $chat_id
     * @param array $ids
     * @return Promise<Collection<?Message>>
     */
    protected function getMessages($chat_id, array $ids = []): Promise
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
                return new Message(json_decode($message, true));
            }

            return new Message([]);
        });
    }
}