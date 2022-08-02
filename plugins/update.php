<?php


use Botify\Types\Map\Message;
use Botify\Utils\Plugins\Plugin;

return Plugin::apply(function (Message $message) {
    if ($message->command('update')) {
        return yield $message->reply(json_encode($message->toArray(), 448));
    }
});