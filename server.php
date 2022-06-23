<?php

require_once __DIR__ .'/bootstrap/app.php';


use Amp\Delayed;
use Jove\EventHandler;
use Jove\TelegramAPI;
use Jove\Types\Update;

Amp\Loop::run(function () {
    $bot = new TelegramAPI();
    $bot->setEventHandler(new class extends EventHandler {
        public function onUpdateNewMessage(Update $update): Generator
        {
            $replied = yield $update->message->reply('Hi');
            yield new Delayed(3000);
            yield $replied->edit('sss');
        }
    });
    $bot->loop();

//    $servers = [
//        Socket\Server::listen("0.0.0.0:1337"),
//        Socket\Server::listen("[::]:1337"),
//    ];
//
//    $logHandler = new StreamHandler(new ResourceOutputStream(\STDOUT));
//    $logHandler->setFormatter(new ConsoleFormatter);
//    $logger = new Logger('server');
//    $logger->pushHandler($logHandler);
//    $router = new Router;
//
//    $handler = new CallableRequestHandler(function () {
//        $api = new TelegramAPI();
//
//        $fn = fn($id) => call(function () use ($api, $id) {
//            $message = yield $api->sendPhoto(-1001187469156, __DIR__ . '/storage/images/cat2.png');
//            if ($message->isOk()) {
//                $message = yield $message->edit('Message caption was edited');
//                yield new Delayed(1000);
//                yield $message->edit('Deleting ...');
//                yield new Delayed(1000);
//                return $message->delete();
////                if ($edited->isOk()) {
////                    yield new Delayed(1000);
////                    return $edited->delete();
////                }
//            }
//
//        });
//
//        foreach (range(1, 1) as $i)
//            $promises[] = $fn($i);
//
//        dump(yield all($promises));
//
//        return new Response(Status::OK, ['content-type' => 'application/json'], getenv('BOT_TOKEN'));
//    });
//
//    $router->addRoute('GET', '/', stack($handler, new AuthorizeWebhooks()));
//
//    $server = new Server($servers, $router, $logger);
//    yield $server->start();
//
//    Amp\Loop::onSignal(SIGINT, function (string $watcherId) use ($server) {
//        Amp\Loop::cancel($watcherId);
//        yield $server->stop();
//    });
});
