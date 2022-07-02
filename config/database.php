<?php


use Medoo\Drivers\MySQL;
use Medoo\Drivers\SQLite;

return [
    'default' => env('DB_TYPE', 'mysql'),
    'connections' => [
        'mysql' => [
            'driver' => MySQL::class,
            'host' => env('DB_HOST'),
            'database_name' => env('DB_NAME'),
            'username' => env('DB_USER'),
            'password' => env('DB_PASS'),
            'port' => env('DB_PORT'),
        ],
        'sqlite' => [
            'driver' => SQLite::class,
            'host' => env('DB_HOST'),
            'database_name' => env('DB_NAME')
        ]
    ]
];