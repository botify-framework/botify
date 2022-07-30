<?php

use function Botify\config;

defined('__BASE_DIR__') || define('__BASE_DIR__', $_ENV['__BASE_DIR__'] ?? __DIR__ . '/../');

define('START_TIME', microtime(true));

require_once __DIR__ . '/../vendor/autoload.php';

$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

$dotenv = Dotenv\Dotenv::create($repository, __BASE_DIR__, ['.env', '.env.example']);
$dotenv->load();

date_default_timezone_set(config('app.timezone'));