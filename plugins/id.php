<?php

use Jove\Utils\Plugins\Plugin;
use const Jove\Utils\Plugins\Filter\IS_MESSAGE;

$filters = [
    IS_MESSAGE
];

return Plugin::apply($filters, function () {
    $message = $this->message;

    if ($message->eq('/id')) {
        if (isset($message['reply_to_message'])) {
            yield $message->reply($message['reply_to_message']['from']['id']);
        } else {
            yield $message->reply($message['from']['id']);
        }
    }
});