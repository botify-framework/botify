<?php

use Botify\Application;

defined('__BASE_DIR__') || define('__BASE_DIR__', $_ENV['__BASE_DIR__'] ?? __DIR__ . '/../');

define('START_TIME', microtime(true));

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application;

return $app;