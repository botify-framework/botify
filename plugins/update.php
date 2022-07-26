<?php


use Jove\Types\Map\Message;
use Jove\Utils\Plugins\Plugin;

return Plugin::apply(function (Message $message) {
    if ($message->command('update')) {
        yield $message->reply(json_encode($message->toArray(), 448));
    }
});