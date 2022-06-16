<?php

require_once __DIR__ .'/bootstrap/app.php';


use Amp\ByteStream\ResourceOutputStream;
use Amp\Delayed;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Server\Router;
use Amp\Http\Server\Server;
use Amp\Http\Status;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Socket;
use Jove\Middlewares\TrustIsTelegram;
use Monolog\Logger;

use function Amp\Http\Server\Middleware\stack;
use function Amp\Promise\all;

// Run this script, then visit http://localhost:1337/ in your browser.

Amp\Loop::run(function () {
    $servers = [
        Socket\Server::listen("0.0.0.0:1337"),
        Socket\Server::listen("[::]:1337"),
    ]; 

    $logHandler = new StreamHandler(new ResourceOutputStream(\STDOUT));
    $logHandler->setFormatter(new ConsoleFormatter);
    $logger = new Logger('server');
    $logger->pushHandler($logHandler);
    $router = new Router;

    $handler = new CallableRequestHandler(function () {
        yield all([new Delayed(3000), new Delayed(3000)]);

        return new Response(Status::OK, ['content-type' => 'text/plain'], 'Hello, world!');
    });
    
    $router->addRoute('GET', '/', stack($handler, new TrustIsTelegram()));

    $server = new Server($servers, $router, $logger);
    yield $server->start();

    Amp\Loop::onSignal(SIGINT, function (string $watcherId) use ($server) {
        Amp\Loop::cancel($watcherId);
        yield $server->stop();
    });
});
