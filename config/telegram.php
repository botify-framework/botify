<?php

return [
    'token' => env('BOT_TOKEN', ''),
    'owner' => (int)env('OWNER_ID'),
    'admins' => array_filter(array_map(fn($admin) => (int)trim($admin), explode(
        ',', env('ADMINS'),
    ))),
];