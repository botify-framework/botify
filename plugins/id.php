<?php


use Jove\TelegramAPI;
use Jove\Types\Update;
use Jove\Utils\Plugins\Plugin;

$filters = [
    fn(TelegramAPI $api, Update $update) => isset($update['message'])
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