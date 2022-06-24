<?php

namespace Jove;

use Generator;
use Jove\Types\Map\CallbackQuery;
use Jove\Types\Map\InlineQuery;
use Jove\Types\Map\Message;
use Jove\Types\Update;
use function Amp\call;

abstract class EventHandler
{

    private TelegramAPI $api;

    const UPDATE_TYPE_WEBHOOK = 1;

    const UPDATE_TYPE_POLLING = 2;

    const UPDATE_TYPE_SOCKET_SERVER = 3;

    public function boot(Update $update)
    {
        $this->api = $update->api;

        call([$this, 'onAny'], $update);

        if (($message = $update->message) || ($message = $update->edited_message)) {
            call([$this, 'onUpdateNewMessage'], $message);
        } elseif ($callbackQuery = $update->callback_query) {
            call([$this, 'onUpdateCallbackQuery'], $callbackQuery);
        } elseif ($inlineQuery = $update->inline_query) {
            call([$this, 'onInlineQuery'], $inlineQuery);
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
     * @param Message $message
     * @return Generator
     */
    abstract public function onUpdateNewMessage(Message $message): Generator;

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
    public function onInlineQuery(InlineQuery $inlineQuery): Generator
    {
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
        return $this->api->{$name}(... $arguments);
    }
}