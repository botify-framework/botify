<?php

use Jove\Types\Map\Message;
use Jove\Utils\Plugins\Plugin;

return Plugin::apply(function (Message $message) {
    if ($message->command(['id', 'info', 'me'])) {
        $message = $message['reply_to_message'] ?? $message;
        $user = !empty($message->matches[1])
            ? yield $this->getUser($message->matches[1])
            : yield $this->getUser($message['from']['id']);

        if ($user) {
            $photos = yield $user->getProfilePhotos(limit: 10);
            $caption = sprintln('User Information');
            $caption .= sprintln('First name: ' . $user['first_name']);
            $caption .= isset($user['last_name']) ? sprintln('Last name: ' . $user['last_name']) : '';
            $caption .= sprintln('ID: ' . $user['id']);
            $caption .= isset($user['username']) ? sprintln('Username: @' . $user['username']) : '';
            $caption .= isset($user['bio']) ? sprintln('Biography: ' . $user['bio']) : '';

            if (in_array($message['chat']['type'], ['supergroup', 'group'])) {
                $chat = $message['chat'];
                $caption .= sprintln("\n", 'Group Information');
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
    }
});