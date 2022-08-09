<?php


use Botify\Utils\Logger\Logger;
use function Botify\env;
use function Botify\storage_path;

return [
    'environment' => env('APP_ENV', 'development'),
    'logger_level' => (int)env('LOGGER_LEVEL', 0),
    // Bitwise support (Logger::ECHO_TYPE | Logger::FILE_TYPE)
    'logger_type' => (int)env('LOGGER_TYPE', Logger::ECHO_TYPE | Logger::FILE_TYPE),
    'logger_file' => storage_path('logs/botify.log'),
    'logger_max_size' => (int)env('LOGGER_MAX_SIZE', 1024),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'static_folder' => env('STATIC_FOLDER'),
];