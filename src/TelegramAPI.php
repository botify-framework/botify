<?php

namespace Jove;

use Amp\ByteStream\ResourceOutputStream;
use Amp\Http\Client\Body\FormBody;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use Amp\Http\Server;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Loop;
use Amp\Promise;
use Amp\Socket;
use Jove\Methods\Methods;
use Jove\Types\Update;
use Monolog\Logger;
use function Amp\call;

class TelegramAPI
{
    use Methods;

    private static $client;
    private EventHandler $eventHandler;
    private $autoFill = [];
    /**
     * @param $eventHandler
     * @return EventHandler
     * @throws \Exception
     */
    public function setEventHandler($eventHandler): EventHandler
    {
        if ($eventHandler instanceof EventHandler) {
            return $this->eventHandler = $eventHandler;
        }

        throw new \Exception(sprintf(
            'The eventHandler must be instance of %s', EventHandler::class,
        ));

    }

    public function hear($updateType = EventHandler::UPDATE_TYPE_WEBHOOK)
    {
        switch ($updateType) {
            case EventHandler::UPDATE_TYPE_WEBHOOK:
                Loop::run(function () {
                    $servers = [
                        Socket\Server::listen('0.0.0.0:8000'),
                        Socket\Server::listen('[::]:8000'),
                    ];

                    $logHandler = new StreamHandler(new ResourceOutputStream(\STDOUT));
                    $logHandler->setFormatter(new ConsoleFormatter);
                    $logger = new Logger('server');
                    $logger->pushHandler($logHandler);

                    $handler = new CallableRequestHandler(function (Server\Request $request) {
                        $update = json_decode(yield $request->getBody()->buffer(), true);

                        call(fn() => $this->eventHandler->boot(new Update($update)));

                        return new Response(Status::OK);
                    });

                    $server = new Server\HttpServer($servers, $handler, $logger);

                    yield $server->start();

                    Loop::onSignal(\SIGINT, function (string $watcherId) use ($server) {
                        Loop::cancel($watcherId);
                        yield $server->stop();
                    });
                });
                break;
            case EventHandler::UPDATE_TYPE_POLLING:
                Loop::run(function () {
                    $offset = -1;

                    Loop::repeat(1000, function () use (&$offset) {
                        $updates = yield $this->getUpdates($offset);
                        if (is_array($updates)) {
                            foreach ($updates as $update) {
                                $offset = $update->update_id + 1;
                                call(fn() => $this->eventHandler->boot($update));
                            }
                        }
                    });
                });
                break;
            default:
                throw new \Exception('Unsupported update handling type.');
        }
    }

    /**
     * @param $uri
     * @param array $attributes
     * @return Promise
     */
    protected function post($uri, array $attributes = []): Promise
    {
        $attributes = array_merge($this->getAutoFill(), $attributes);
        return call(function () use ($uri, $attributes) {
            $client = static::$client ??= HttpClientBuilder::buildDefault();
            $promise = yield $client->request(
                $this->generateRequest($uri, $attributes)
            );
            return json_decode(
                yield $promise->getBody()->buffer(), true
            );
        });
    }

    /**
     * @param $uri
     * @param array $data
     * @return Request
     */
    private function generateRequest($uri, array $data = []): Request
    {
        return \tap(new Request($this->generateUri($uri), 'POST'), fn($request) => $request->setBody(
            $this->generateBody($data)
        ));
    }

    /**
     * @param array $fields
     * @return FormBody
     */
    private function generateBody(array $fields): FormBody
    {
        $body = new FormBody();
        $fields = \array_filter($fields);

        foreach ($fields as $fieldName => $content)
            if (\is_string($content) && \file_exists($content) && \filesize($content) > 0)
                $body->addFile($fieldName, $content);
            else
                $body->addField($fieldName, $content);

        return $body;
    }

    /**
     * @param $uri
     * @param array $queries
     * @return string
     */
    private function generateUri($uri, array $queries = []): string
    {
        $url = \sprintf('https://api.telegram.org/bot%s/', \getenv('BOT_TOKEN'));

        if (! empty($uri))
            $url .= \ltrim($uri, '/');

        if (! empty($queries))
            $url .= '?' . \http_build_query($queries);

        return $url;
    }

    /**
     * @param $array
     * @param $overRide
     * @return $this
     */
    public function setAutoFill(array $array,int|bool|string|null $overRide=false) :self {
        $overRide = (bool) $overRide;
        $this->autoFill = \array_merge($overRide ? [] : $this->autoFill, $array);
       return $this; 
    }
    /**
     * @return array $this->autoFill;
     */
    public function getAutoFill() :array {
        return  $this->autoFill;
    }
}
