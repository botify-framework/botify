<?php

namespace Jove\Traits;

use Amp\Producer;

trait HasHistory
{

    public function readHistory(callable $filter = null): Producer
    {
        return $this->api->getHistory(
            $this->id, $filter,
        );
    }
}