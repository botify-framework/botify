<?php


use Jove\Types\Map\Message;
use Jove\Utils\Plugins\Pluggable;
use const Jove\Utils\Plugins\Filter\IS_MESSAGE;

$filters = [
    IS_MESSAGE,
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