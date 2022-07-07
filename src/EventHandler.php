<?php

namespace Jove;

use Amp\Promise;
use ArrayAccess;
use Closure;
use Jove\Types\Map\CallbackQuery;
use Jove\Types\Map\InlineQuery;
use Jove\Types\Map\Message;
use Jove\Types\Update;
use Medoo\DatabaseConnection;
use Psr\Log\LoggerInterface;
use Throwable;
use function Amp\call;

class EventHandler implements ArrayAccess
{

    const UPDATE_TYPE_WEBHOOK = 1;
    const UPDATE_TYPE_POLLING = 2;
    const UPDATE_TYPE_SOCKET_SERVER = 3;
    private static array $events = [];
    public ?TelegramAPI $api = null;
    public $current;
    public ?DatabaseConnection $database = null;
    public LoggerInterface $logger;
    private ?Update $update = null;

    /**
     * Use this method for inline events
     *
     * @param $events
     * @param callable $listener
     * @return void
     */
    public static function on($events, callable $listener)
    {
        $events = array_map(fn($event) => strtolower($event), (array)$events);

        foreach ($events as $event) {
            if (!in_array($listener, static::$events[$event] ?? [])) {
                static::$events[$event][] = $listener;
            }
        }
    }

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
        return $this->current->{$name};
    }

    /**
     * Bootstrap the event handler
     *
     * @param Update $update
     * @param DatabaseConnection|null $database
     * @return Promise
     */
    public function boot(Update $update, ?DatabaseConnection $database = null): Promise
    {
        return call(function () use ($database, $update) {
            $this->update = $update;
            $this->database = $database;
            $this->api = $update->api;
            $this->logger = $this->api->logger;

            $events = array_merge_recursive(static::$events, [
                'message' => [
                    [$this, 'onUpdateNewMessage']
                ],
                'edited_message' => [
                    [$this, 'onUpdateNewMessage']
                ],
                'channel_post' => [
                    [$this, 'onUpdateNewChannelMessage']
                ],
                'edited_channel_post' => [
                    [$this, 'onUpdateNewChannelMessage']
                ],
                'callback_query' => [
                    [$this, 'onUpdateCallbackQuery']
                ],
                'inline_query' => [
                    [$this, 'onUpdateInlineQuery']
                ]
            ]);

            $promises = [call([$this, 'onAny'], $update)];

            foreach ($events as $event => $listeners) {
                if (isset ($update[$event])) {
                    $current = $update[$event];

                    foreach ($listeners as $listener) {
                        if ($listener instanceof Closure) {
                            $self = clone $this;
                            $self->current = $current;
                            $listener = $listener->bindTo($self);
                        }
                        if (is_array($listener)) {
                            $self = clone $listener[0];
                            $self->current = $current;
                            $listener[0] = $self;
                        }

                        $promises[] = call($listener, $update[$event]);
                    }
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
        return isset($this->current->{$offset});
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->current->{$offset};
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->current[] = $value;
        } else {
            $this->current[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->current[$offset]);
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
     * @param TelegramAPI $api
     * @return void
     */
    public function setApi(TelegramAPI $api)
    {
        $this->api = $api;
    }
}