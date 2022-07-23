<?php

use Jove\Types\Map\Message;
use Jove\Utils\Plugins\Plugin;

return Plugin::apply(function (Message $message) {
    if ($message->eq('/id')) {
        $message = $message['reply_to_message'] ?? $message;

        yield $message->reply($message['from']['id']);
    }
});