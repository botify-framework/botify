<?php

use Botify\Types\Map\Message;
use Botify\Utils\Plugins\Plugin;
use function Botify\{sprintln,array_first};

return Plugin::apply(function (Message $message) {
    if ($message->command(['id', 'info', 'me'])) {
        $message = $message['reply_to_message'] ?? $message;
        $message = $message['reply_to_message'] ?? $message;
        $id = match (true) {
            isset($message['entities']) && $user = array_first($message['entities'], fn($entity) => $entity['type'] === 'text_mention') => $user['user']['id'],
            isset($message->matches[1]) => $message->matches[1],
            default => $message['from']['id']
        };
        if ($user = yield $this->getUser($id)) {
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

            return yield $message->reply($caption);
        }
    }
});