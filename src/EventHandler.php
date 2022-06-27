<?php

namespace Jove;

use Closure;
use Generator;
use Jove\Types\Map\CallbackQuery;
use Jove\Types\Map\InlineQuery;
use Jove\Types\Map\Message;
use Jove\Types\Update;
use function Amp\call;

abstract class EventHandler
{

    const UPDATE_TYPE_WEBHOOK = 1;
    const UPDATE_TYPE_POLLING = 2;
    const UPDATE_TYPE_SOCKET_SERVER = 3;
    private static array $events = [];
    public $current;
    private Update $update;

    public static function on(string $event, callable $listener)
    {
        $event = strtolower($event);

        if (!in_array($listener, static::$events[$event] ?? [])) {
            static::$events[$event][] = $listener;
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

    public function boot(Update $update)
    {
        $this->update = $update;

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
                        $listener = $listener->bindTo($this);
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
}