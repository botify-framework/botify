<?php

use Botify\Types\Map\Message;
use Botify\Utils\Plugins\Plugin;
use function Botify\{array_last, sprintln, array_first};

return Plugin::apply(function (Message $message) {
    if ($message->command(['id', 'info', 'me'])) {
        $message = $message['reply_to_message'] ?? $message;

        if ($user = yield $this->getUser(match (true) {
            isset($message['entities']) && $user = array_first($message['entities'], fn($entity) => $entity['type'] === 'text_mention') => $user['user']['id'],
            !empty($message->matches[1]) => $message->matches[1],
            default => $message['from']['id']
        })) {
            $photos = $user->getProfilePhotos(limit: 10);
            $media = [];
            while (yield $photos->advance()) {
                $media[] = [
                    'type' => 'photo',
                    'media' => array_last($photos->getCurrent())['file_id'],
                ];
            }
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

            if (!empty($media)) {
                $media[array_key_last($media)]['caption'] = $caption;

                return yield $message->replyMediaGroup($media, caption: $caption);
            }

            return yield $message->reply($caption);
        }
    }
});