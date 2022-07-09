<?php

return [
    'base_uri' => env('TELEGRAM_BASE_URI', 'https://api.telegram.org'),
    'token' => env('BOT_TOKEN', ''),
    'super_admin' => (int)env('SUPER_ADMIN'),
    'admins' => function () {
        $admins = array_filter(array_map(
            fn($admin) => (int)trim($admin), explode(',', env('ADMINS'),
        )));

        array_unshift($admins, (int)env('SUPER_ADMIN'));

        return array_unique($admins);
    },
    'http' => [
        'inactivity_timeout' => env('INACTIVITY_TIMEOUT', 10000),
        'transfer_timeout' => env('TRANSFER_TIMEOUT', 10000),
        'body_size_limit' => env('BODY_SIZE_LIMIT', 10000),
    ],
    'loop_interval' => 100
];