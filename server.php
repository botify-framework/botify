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
use Jove\TelegramAPI;
use Monolog\Logger;

use function Amp\call;
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
        $api = new TelegramAPI();

        yield $api->sendMessage(-1001187469156, 'Hi');

        $fn = fn ($id) => call(function () use ($api, $id) {
            $chat = yield $api->getChatMember(-1001679931840, $id);

            return yield $api->sendMessage(-1001679931840, var_export($chat, true));
        });

        foreach([342929908, 156829329, 357377817, 277969532, 1692387237, 343434] as $i)
            $promises[] = $fn($i);
        
        dump(yield all($promises));

        return new Response(Status::OK, ['content-type' => 'application/json'], getenv('BOT_TOKEN'));
    });
    
    $router->addRoute('GET', '/', stack($handler, new TrustIsTelegram()));

    $server = new Server($servers, $router, $logger);
    yield $server->start();

    Amp\Loop::onSignal(SIGINT, function (string $watcherId) use ($server) {
        Amp\Loop::cancel($watcherId);
        yield $server->stop();
    });
});
