<?php


use Jove\Types\Map\Message;
use Jove\Utils\Plugins\Pluggable;

return new class() extends Pluggable {
    public Message $message;

    public function handle(Message $message)
    {
        if ($message->eq('/start')) {
            yield $message->reply('Hello world');
        }
    }
};