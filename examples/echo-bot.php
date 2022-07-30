<?php

use Botify\Events\Handler;
use Botify\TelegramAPI;
use Botify\Types\Map\{Message};

require_once __DIR__ . '/../bootstrap/app.php';

$bot = new TelegramAPI();

$bot->on('message', function (Message $message) {
    yield $message->copy();
});

$bot->hear(Handler::UPDATE_TYPE_POLLING);