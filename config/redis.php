<?php


use function Botify\env;

return [
    'host' => env('REDIS_HOST', '127.0.0.1'),
    'port' => env('REDIS_PORT', 6379),
    'password' => env('REDIS_PASSWORD'),
    'timeout' => env('REDIS_TIMEOUT', 10),
    'database' => env('REDIS_DATABASE', 0)
];