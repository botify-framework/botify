<?php

namespace Botify\Methods\Messages;

use Amp\Producer;
use Amp\Promise;
use Amp\Redis\RedisException;
use Botify\Types\Map\Message;
use Botify\Utils\Collection;
use function Amp\call;
use function Botify\collect;
use function Botify\gather;

trait GetMessages
{

    /**
     * @param int $chat_id
     * @param ?callable $filter
     * @param int $limit
     * @return Producer
     */
    protected function getHistory(int $chat_id, callable $filter = null, int $limit = 100): Producer
    {
        return new Producer(function ($emit) use ($chat_id, $filter, $limit) {
            try {
                $messages = yield $this->redis?->getMap('messages:' . $chat_id)->getAll();

                foreach (array_reverse($messages) as $message) {
                    if ($message = json_decode($message, true)) {
                        $message = new Message($message);

                        if (is_callable($filter)) {
                            if ($filter($message)) {
                                $limit--;
                                yield $emit($message);
                            }
                        } else {
                            $limit--;
                            yield $emit($message);
                        }

                        if ($limit <= 0)
                            return;
                    }
                }
            } catch (RedisException $exception) {
                $this->logger->warning('You must configure or enable redis');
            }
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
            try {
                if ($message = yield $this->redis?->getMap('messages:' . $chat_id)->getValue($message_id)) {
                    return new Message(json_decode($message, true));
                }

                return new Message([]);
            } catch (RedisException $exception) {
                $this->logger->warning('You must configure or enable redis');
            }
        });
    }
}