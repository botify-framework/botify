<?php


use Jove\Types\Map\Message;
use Jove\Utils\Plugins\Pluggable;

return new class() extends Pluggable {
    public Message $message;

    public function boot()
    {
        $this->message = $this->update['message'];
    }

    public function handle()
    {
        if ($this->message->eq('/start')) {
            yield $this->message->reply('Hello world');
        }
    }
};