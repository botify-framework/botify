<?php

use Jove\EventHandler;
use Jove\TelegramAPI;
use Jove\Types\Map\Message;

require_once __DIR__ . '/../bootstrap/app.php';

$bot = new TelegramAPI();

$bot->on('message', function (Message $message) {
    yield $message->copy();
});

$bot->hear(EventHandler::UPDATE_TYPE_POLLING);