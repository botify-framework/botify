<?php

namespace Jove;

use Generator;
use Jove\Types\Update;
use function Amp\call;

abstract class EventHandler
{
    public function boot(Update $update)
    {
        call([$this, 'onAny'], $update);

        if ($update->isMessage() || $update->isEditedMessage()) {
            call([$this, 'onUpdateNewMessage'], $update);
        } elseif ($update->isCallbackQuery()) {
            call([$this, 'onUpdateCallbackQuery'], $update);
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
     * @param Update $update
     * @return Generator
     */
    abstract public function onUpdateNewMessage(Update $update): Generator;

    /**
     * @param Update $update
     * @return Generator
     */
    public function onUpdateCallbackQuery(Update $update): Generator
    {
    }
}