<?php

use Jove\Types\Map\Message;
use Jove\Utils\Plugins\Plugin;

return Plugin::apply(function (Message $message) {
    if ($message->command(['id', 'info', 'me'])) {
        $message = $message['reply_to_message'] ?? $message;
        $from = $message['from'];

        $photos = yield $from->getProfilePhotos(limit: 10);
        $caption = sprintln('User Information');
        $caption .= sprintln('First name: ' . $from['first_name']);
        $caption .= isset($from['last_name']) ? sprintln('Last name: ' . $from['last_name']) : '';
        $caption .= sprintln('ID: ' . $from['id']);
        $caption .= isset($from['bio']) ? sprintln('Biography: ' . $from['bio']) : '';

        if (in_array($message['chat']['type'], ['supergroup', 'group'])) {
            $chat = $message['chat'];
            $caption .= sprintln('Group Information');
            $caption .= sprintln('Title: ' . $chat['title']);
            $caption .= sprintln('ID: ' . $chat['id']);
        }

        if ($photos->isNotEmpty()) {
            $media = $photos->map(function ($photo) {
                return [
                    'type' => 'photo',
                    'media' => end($photo)['file_id'],
                ];
            })->toArray();
            $media[array_key_last($media)]['caption'] = $caption;

            return yield $message->replyMediaGroup($media, caption: $caption);
        }

        yield $message->reply($caption);
    }
});