<?php

return [
    'token' => env('BOT_TOKEN', ''),
    'super_admin' => (int)env('SUPER_ADMIN'),
    'admins' => function () {
        $admins = array_filter(array_map(
            fn($admin) => (int)trim($admin), explode(',', env('ADMINS'),
        )));

        return array_unshift($admins, config('telegram.super_admin'));
    },
    'cache_chat' => env('CACHE_CHAT'),
];