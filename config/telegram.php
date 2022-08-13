<?php

use function Botify\base_path;
use function Botify\env;

return [
    'base_uri' => env('TELEGRAM_BASE_URI', 'https://api.telegram.org'),
    'token' => $token = env('BOT_TOKEN'),
    'bot_username' => env('BOT_USERNAME'),
    'secret_token' => env('SECRET_TOKEN'),
    'super_admin' => (int)env('SUPER_ADMIN'),
    'admins' => function () {
        $admins = array_filter(array_map(
            fn($admin) => (int)trim($admin), explode(',', env('ADMINS', ''),
        )));

        array_unshift($admins, (int)env('SUPER_ADMIN'));

        return array_unique($admins);
    },
    'http' => [
        'inactivity_timeout' => env('INACTIVITY_TIMEOUT', 10000),
        'transfer_timeout' => env('TRANSFER_TIMEOUT', 10000),
        'body_size_limit' => env('BODY_SIZE_LIMIT', 10000),
    ],
    'loop_interval' => env('LOOP_INTERVAL', 100),
    'socket_server' => [
        'host' => env('SERVER_ADDRESS', '0.0.0.0'),
        'port' => env('SERVER_PORT', 8000)
    ],
    'cache_messages' => env('CACHE_MESSAGES', true),
    'plugins_dir' => base_path('plugins'),
    'typing_mode' => env('TYPING_MODE', false),
    'allowed_updates' => ['message', 'edited_message', 'callback_query', 'inline_query', 'poll', 'poll_answer'],
    'sleep_threshold' => env('SLEEP_THRESHOLD', 30),
];