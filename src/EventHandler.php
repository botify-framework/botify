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

    private Update $update;
    private static array $events = [];

    const UPDATE_TYPE_WEBHOOK = 1;

    const UPDATE_TYPE_POLLING = 2;

    const UPDATE_TYPE_SOCKET_SERVER = 3;

    public static function on(string $event, callable $listener)
    {
        $event = strtolower($event);

        if(! in_array($listener, static::$events[$event])) {
            static::$events[$event][] = $listener;
        }
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
                foreach ($listeners as $listener) {
                    if ($listener instanceof Closure) {
                        $listener = $listener->bindTo($this);
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
    {}

    /**
     * @param Message $message
     * @return Generator
     */
    public function onUpdateNewMessage(Message $message): Generator
    {}

    /**
     * @param CallbackQuery $callbackQuery
     * @return Generator
     */
    public function onUpdateCallbackQuery(CallbackQuery $callbackQuery): Generator
    {}

    /**
     * @param InlineQuery $inlineQuery
     * @return Generator
     */
    public function onUpdateInlineQuery(InlineQuery $inlineQuery): Generator
    {}

    /**
     * Dynamic method proxy for calling TelegramAPI methods
     *
     * @param $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments = [])
    {
        return $this->update->api->{$name}(... $arguments);
    }
}