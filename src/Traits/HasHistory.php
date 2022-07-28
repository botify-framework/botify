<?php

namespace Botify\Traits;

use Amp\Producer;

trait HasHistory
{

    public function readHistory(callable $filter = null, int $limit = 100): Producer
    {
        return $this->getAPI()->getHistory(
            $this->id, $filter, $limit
        );
    }
}