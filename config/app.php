<?php


use Jove\Utils\Logger\Logger;

return [
    'environment' => env('APP_ENV', 'development'),
    'logger_level' => (int)env('LOGGER_LEVEL', 0),
    // Bitwise support (Logger::ECHO_TYPE | Logger::FILE_TYPE)
    'logger_type' => (int)env('LOGGER_TYPE', Logger::ECHO_TYPE),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
];