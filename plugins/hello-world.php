<?php


use Botify\Types\Map\Message;
use Botify\Utils\Plugins\Pluggable;

return new class() extends Pluggable {
    public Message $message;

    public function handle(Message $message)
    {
        if ($message->eq('/start')) {
            return yield $message->reply('Hello world');
        }
    }
};