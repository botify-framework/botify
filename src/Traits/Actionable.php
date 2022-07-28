<?php

namespace Botify\Traits;

use Amp\Promise;

trait Actionable
{
    public function action($action = 'typing'): Promise
    {
        return $this->getAPI()->sendChatAction([
            'chat_id' => $this->id,
            'action' => $action,
        ]);
    }
}