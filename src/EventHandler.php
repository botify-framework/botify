<?php

namespace Jove;

use Amp\Promise;
use ArrayAccess;
use Closure;
use Generator;
use Jove\Types\Map\CallbackQuery;
use Jove\Types\Map\InlineQuery;
use Jove\Types\Map\Message;
use Jove\Types\Update;
use Medoo\DatabaseConnection;
use function Amp\call;

class EventHandler implements ArrayAccess
{

    const UPDATE_TYPE_WEBHOOK = 1;
    const UPDATE_TYPE_POLLING = 2;
    const UPDATE_TYPE_SOCKET_SERVER = 3;
    private static array $events = [];
    public $current;
    private Update $update;
    public ?DatabaseConnection $database = null;


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

        return $this->update->api->{$name}(... $arguments);
    }

    public function boot(Update $update, ?DatabaseConnection $database = null): Promise
    {
        $this->update = $update;
        $this->database = $database;

        call([$this, 'onAny'], $update);

        $events = array_merge_recursive(static::$events, [
            'message' => [
                [$this, 'onUpdateNewMessage']
            ],
            'edited_message' => [
                [$this, 'onUpdateNewMessage']
            ],
            'callback_query' => [
                [$this, 'onUpdateCallbackQuery']
            ],
            'inline_query' => [
                [$this, 'onUpdateInlineQuery']
            ]
        ]);

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

                    call($listener, $update[$event]);
                }
            }
        }
    }

    /**
     * @param Update $update
     * @return Generator
     */
    public function onAny(Update $update): Generator
    {
    }

    /**
     * @param CallbackQuery $callbackQuery
     * @return Generator
     */
    public function onUpdateCallbackQuery(CallbackQuery $callbackQuery): Generator
    {
    }

    /**
     * @param InlineQuery $inlineQuery
     * @return Generator
     */
    public function onUpdateInlineQuery(InlineQuery $inlineQuery): Generator
    {
    }

    /**
     * @param Message $message
     * @return Generator
     */
    public function onUpdateNewMessage(Message $message): Generator
    {
    }

    public function __get($name)
    {
        return $this->current->{$name};
    }

    public function offsetExists(mixed $offset)
    {
        return isset($this->current->{$offset});
    }

    public function offsetGet(mixed $offset)
    {
        return $this->current->{$offset};
    }

    public function offsetSet(mixed $offset, mixed $value)
    {
        if (is_null($offset)) {
            $this->current[] = $value;
        } else {
            $this->current[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset)
    {
        unset($this->current[$offset]);
    }
}