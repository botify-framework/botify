<?php

require_once __DIR__ .'/bootstrap/app.php';


use Jove\EventHandler;
use Jove\TelegramAPI;
use Jove\Types\Update;

Amp\Loop::run(function () {
    $bot = new TelegramAPI();

    $bot->setEventHandler(new class extends EventHandler {
        /**
         * Handle new incoming messages update
         *
         * @param Update $update
         * @return Generator
         */
        public function onUpdateNewMessage(Update $update): Generator
        {
            $message = $update->message;
            $text = $message->text;
            $fromId = $message->from->id;

            if (preg_match('/^[\/#!.]?(e|r)\s?(.*)$/usi', $text, $match) && $fromId == getenv('OWNER_ID')) {
                $errors = [];
                $buffers = [];
                $result = null;
                $runnable = <<<CODE
\$__temp_vars = get_defined_vars();
return \Amp\call(function () use (\$__temp_vars) {
    extract(\$__temp_vars);
    unset(\$__temp_vars);
    $match[2]
});
CODE;
                set_error_handler(function ($errno, $message) use (&$errors) {
                    $errors[] = $message;
                });
                ob_start();

                try {
                    yield eval($runnable);
                    $buffers[] = ob_get_contents();
                } catch (\Throwable $e) {
                    $errors[] = $e->getMessage() . "\n" .
                        'In Line : ' . $e->getLine() . "\n" .
                        'At File : ' . basename($e->getFile());
                }

                $result .= !empty($buffers) ? "<b>Result:</b>\n" . htmlspecialchars(
                        implode("\n", $buffers)
                    ) . "\n" : null;

                $result .= !empty($errors) ? "<b>Errors:</b>\n" . htmlspecialchars(
                        implode("\n", $errors)
                    ) : null;

                ob_end_clean();

                if (empty($result)) {
                    return yield $message->reply('No Response !');
                }

                mb_regex_encoding('UTF-8');
                mb_internal_encoding('UTF-8');

                $responses = str_split($result, 4000);
                foreach ($responses as $response) {
                    yield $message->reply($response);
                }
            }
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
