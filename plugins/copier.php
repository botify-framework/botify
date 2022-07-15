<?php


use Jove\TelegramAPI;
use Jove\Types\Update;
use Jove\Utils\Plugins\Plugin;

$filters = [
    function (TelegramAPI $api, Update $update) {
        return isset($update['message']);
    },
];

return Plugin::apply($filters, function () {
    yield $this->message->copy();
});