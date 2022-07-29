<?php

namespace Botify\Events;

use Amp\Promise;
use Amp\Redis\Redis;
use ArrayAccess;
use Botify\TelegramAPI;
use Botify\Types\Map\CallbackQuery;
use Botify\Types\Map\InlineQuery;
use Botify\Types\Map\Message;
use Botify\Types\Update;
use Botify\Utils\DataBag;
use Medoo\DatabaseConnection;
use Psr\Log\LoggerInterface;
use Throwable;
use function Amp\call;

class EventHandler implements ArrayAccess
{
    public ?TelegramAPI $api = null;
    public $current;
    public LoggerInterface $logger;
    public ?Redis $redis = null;
    private DataBag $bag;
    private ?Update $update = null;

    /**
     * Dynamic method proxy for calling TelegramAPI methods
     *
     * @param $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments = [])
    {
        if (is_object($this->current) && method_exists($this->current, $name)) {
            return $this->current->{$name}(... $arguments);
        }

        return $this->api->{$name}(... $arguments) ?? trigger_error(sprintf(
                'Trying to call undefined method [%s]', $name
            ), E_USER_ERROR);
    }

    public function __get($name)
    {
        return $this->bag->{$name} ?? $this->current->{$name};
    }

    /**
     * Bootstrap the event handler
     *
     * @return Promise
     */
    public function fire(): Promise
    {
        return call(function () {
            $events = [
                'message' => [$this, 'onUpdateNewMessage'],
                'edited_message' => [$this, 'onUpdateNewMessage'],
                'channel_post' => [$this, 'onUpdateNewChannelMessage'],
                'edited_channel_post' => [$this, 'onUpdateNewChannelMessage'],
                'callback_query' => [$this, 'onUpdateCallbackQuery'],
                'inline_query' => [$this, 'onUpdateInlineQuery']
            ];

            yield call([$this, 'onStart']);

            $promises = [call([$this, 'onAny'], $this->update)];

            foreach ($events as $event => $listener) {
                if (isset($this->update[$event])) {
                    $current = $this->update[$event];
                    $self = clone $listener[0];
                    $self->current = $current;
                    $listener[0] = $self;
                    $promises[] = call($listener, $current);
                }
            }

            try {
                yield gather($promises);
            } catch (Throwable $e) {
                $this->logger->critical($e);
            }
        });
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->bag->{$offset}) || isset($this->current->{$offset});
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->bag->{$offset} ?? $this->current->{$offset};
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->bag[] = $value;
        } else {
            $this->bag[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->current[$offset], $this->bag[$offset]);
    }

    /**
     * @param Update $update
     */
    public function onAny(Update $update)
    {
    }

    /**
     * This action called when eventHandler was started
     */
    public function onStart()
    {
    }

    /**
     * @param CallbackQuery $callbackQuery
     */
    public function onUpdateCallbackQuery(CallbackQuery $callbackQuery)
    {
    }

    /**
     * @param InlineQuery $inlineQuery
     */
    public function onUpdateInlineQuery(InlineQuery $inlineQuery)
    {
    }

    /**
     * @param Message $message
     */
    public function onUpdateNewChannelMessage(Message $message)
    {
    }

    /**
     * @param Message $message
     */
    public function onUpdateNewMessage(Message $message)
    {
    }

    /**
     * Set TelegramAPI instance
     *
     * @param Update $update
     * @param DataBag $bag
     * @return EventHandler
     */
    final public function register(Update $update, DataBag $bag): EventHandler
    {
        $this->update = $update;
        $this->api = $update->getAPI();
        $this->redis = $this->api->getRedis();
        $this->logger = $this->api->getLogger();
        $this->bag = $bag;
        return $this;
    }
}