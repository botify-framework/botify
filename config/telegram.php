<?php

return [
    'token' => env('BOT_TOKEN', ''),
    'super_admin' => (int)env('SUPER_ADMIN'),
    'admins' => [config('super_admin')] + array_filter(array_map(fn($admin) => (int)trim($admin), explode(
            ',', env('ADMINS'),
        ))),
    'cache_chat' => env('CACHE_CHAT'),
];