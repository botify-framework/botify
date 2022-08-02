<?php


use Botify\Types\Map\Message;
use Botify\Utils\Plugins\Plugin;

return Plugin::apply(function (Message $message) {
    if ($message->command(['ping', 'botify', 'botty'])) {
        $mt = microtime(true);
        $replied = yield $message->reply('Please wait ...');
        return yield $replied->edit('Ping took time: ' . round((microtime(true) - $mt) * 1000, 3) . ' ms');
    }
});