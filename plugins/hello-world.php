<?php


use Jove\TelegramAPI;
use Jove\Types\Map\Message;
use Jove\Types\Update;
use Jove\Utils\Plugins\Pluggable;

$filters = [
    fn(TelegramAPI $api, Update $update) => isset($update['message']) || isset($update['edited_message'])
];
return new class($filters) extends Pluggable {
    public Message $message;

    public function boot()
    {
        $this->message = $this->update['message'] ?? $this->update['edited_message'];
    }

    public function handle()
    {
        if ($this->message->eq('/start')) {
            yield $this->message->reply('Hello world');
        }
    }
};