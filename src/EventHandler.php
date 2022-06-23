<?php

namespace Jove;

use Generator;
use Jove\Types\Update;
use function Amp\call;

abstract class EventHandler
{
    public function boot(Update $update)
    {
        if ($update->isMessage()) {
            call([$this, 'onMessage'], $update);
        }
    }

    /**
     * @param Update $update
     * @return Generator
     */
    abstract public function onMessage(Update $update): Generator;
}