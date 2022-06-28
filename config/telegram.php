<?php

return [
    'token' => env('BOT_TOKEN', ''),
    'super_admin' => (int)env('SUPER_ADMIN'),
    'admins' => function () {
        $admins = array_filter(array_map(
            fn($admin) => (int)trim($admin), explode(',', env('ADMINS'),
        )));

        array_unshift($admins, (int)env('SUPER_ADMIN'));

        return array_unique($admins);
    },
    'cache_chat' => env('CACHE_CHAT'),
];