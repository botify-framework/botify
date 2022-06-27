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
use Jove\Middlewares\AuthorizeWebhooks;
use Jove\Types\Map\Chat;
use Jove\Types\Map\ChatInviteLink;
use Jove\Types\Map\ChatMember;
use Jove\Types\Map\File;
use Jove\Types\Map\MenuButton;
use Jove\Types\Map\MenuButtonCommands;
use Jove\Types\Map\Message;
use Jove\Types\Map\MessageId;
use Jove\Types\Map\Poll;
use Jove\Types\Map\SentWebAppMessage;
use Jove\Types\Map\StickerSet;
use Jove\Types\Map\User;
use Jove\Types\Map\UserProfilePhotos;
use Jove\Types\Map\WebhookInfo;
use Jove\Types\Update;
use Jove\Utils\FallbackResponse;
use Monolog\Logger;
use function Amp\call;

class TelegramAPI
{
    use Methods;

    private static $client;
    private static int $inactivityTimeout = 10000;
    private static int $transferTimeout = 10000;
    private array $default_attributes = [];
    /**
     * @var EventHandler[] $eventHandlers
     */
    private array $eventHandlers = [];
    /**
     * Map all methods responses
     *
     * @var array|string[][]
     */
    private array $responses_map = [
        WebhookInfo::class => [
            'getWebhookInfo'
        ],
        User::class => [
            'getMe'
        ],
        Message::class => [
            'sendMessage',
            'forwardMessage',
            'sendPhoto',
            'sendAudio',
            'sendDocument',
            'sendVideo',
            'sendAnimation',
            'sendVoice',
            'sendVideoNote',
            'sendLocation',
            'editMessageLiveLocation',
            'stopMessageLiveLocation',
            'sendVenue',
            'sendContact',
            'sendPoll',
            'sendDice',
            'editMessageText',
            'editMessageCaption',
            'editMessageMedia',
            'editMessageReplyMarkup',
            'sendSticker',
            'sendInvoice',
            'sendGame',
            'setGameScore',
        ],
        MessageId::class => [
            'copyMessage'
        ],
        UserProfilePhotos::class => [
            'getUserProfilePhotos',
        ],
        File::class => [
            'getFile',
            'uploadStickerFile',
            'createNewStickerSet',
            'addStickerToSet',
        ],
        ChatInviteLink::class => [
            'createChatInviteLink',
            'editChatInviteLink',
            'revokeChatInviteLink',
        ],
        Chat::class => [
            'getChat',
        ],
        ChatMember::class => [
            'getChatMember',
        ],
        MenuButtonCommands::class => [
            'getChatMenuButton',
        ],
        MenuButton::class => [
            'getChatMenuButton',
            'getChatMenuButton',
            'getChatMenuButton',
        ],
        Poll::class => [
            'stopPoll',
        ],
        StickerSet::class => [
            'getStickerSet',
        ],
        SentWebAppMessage::class => [
            'answerWebAppQuery',
        ]
    ];

    private static ?EventHandler $eventHandler = null;

    /**
     * @param $event
     * @param callable $listener
     * @return void
     */
    public static function on($event, callable $listener)
    {
        static::$eventHandler ??= new EventHandler();

        static::$eventHandler->on($event, $listener);
    }

    /**
     * Dynamic proxy Telegram methods
     *
     * @param string $name
     * @param array $arguments
     * @return Promise
     * @throws \Exception
     */
    public function __call(string $name, array $arguments = [])
    {
        static $mapped = [];

        if (empty($mapped))
            foreach ($this->responses_map as $response => $methods)
                foreach ($methods as $method)
                    $mapped[strtolower($method)] = $response;

        $arguments = isset($arguments[0])
            ? [array_merge(array_shift($arguments), $arguments)]
            : [$arguments];

        /**
         * Prepend method name to arguments
         */
        array_unshift($arguments, $name);

        $cast = $mapped[strtolower($name)] ?? false;

        return call(function () use ($arguments, $cast) {
            $response = yield $this->post(... $arguments);

            if ($response['ok']) {
                if (in_array(gettype($response['result']), ['boolean', 'integer', 'string'])) {
                    return $response['result'];
                }

                return new $cast($response['result']);
            }

            return new FallbackResponse($response);
        });
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    public function post($uri, array $attributes = [], bool $stream = false): Promise
    {
        if (isset($attributes['text'])) {
            $text = &$attributes['text'];

            if (is_array($text)) {
                $text = print_r($text, true);
            } elseif (is_object($text) && method_exists($text, '__toString')) {
                $text = var_export($text, true);
            }
        }

        return $this->fetch(__FUNCTION__, $uri, $attributes, $stream);
    }

    /**
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    public function get($uri, array $attributes = [], bool $stream = false): Promise
    {
        return $this->fetch(__FUNCTION__, $uri, $attributes, $stream);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $attributes
     * @param bool $stream
     * @return Promise
     */
    protected function fetch($method, $uri, array $attributes, bool $stream = false): Promise
    {
        $attributes = array_merge_recursive(
            $this->getDefaultAttributes(), $attributes
        );

        return call(function () use ($method, $uri, $attributes, $stream) {
            $client = static::$client ??= HttpClientBuilder::buildDefault();
            $promise = yield $client->request(
                $this->generateRequest($method, $uri, $attributes)
            );

            $body = $promise->getBody();

            if ($stream === true)
                return $body;

            return json_decode(
                yield $body->buffer(), true
            );
        });
    }

    /**
     * @return array
     */
    public function getDefaultAttributes(): array
    {
        return $this->default_attributes;
    }

    /**
     * @param array $attributes
     * @param bool $override
     * @return $this
     */
    public function setDefaultAttributes(array $attributes, bool $override = false): self
    {
        $this->default_attributes = array_merge(
            $override ? [] : $this->getDefaultAttributes(),
            $attributes
        );

        return $this;
    }

    /**
     * @param $method
     * @param $uri
     * @param array $data
     * @return Request
     */
    private function generateRequest($method, $uri, array $data = []): Request
    {
        $method = strtoupper($method);
        $queries = $method === 'GET' ? $data : [];

        return \tap(new Request($this->generateUri($uri, $queries), $method), function (Request $request) use ($queries, $data) {
            if (empty($queries) && !empty($data)) {
                $request->setBody(
                    $this->generateBody($data)
                );
            }
            $request->setInactivityTimeout(static::$inactivityTimeout * 1000);
            $request->setTransferTimeout(static::$transferTimeout * 1000);
        });
    }

    /**
     * @param $uri
     * @param array $queries
     * @return string
     */
    private function generateUri($uri, array $queries = []): string
    {
        $uri = \ltrim($uri, '/');

        $url = filter_var($uri, FILTER_VALIDATE_URL) ?: \sprintf(
            'https://api.telegram.org/bot%s/%s', \getenv('BOT_TOKEN'), $uri
        );

        if (!empty($queries))
            $url .= '?' . \http_build_query($queries);

        return $url;
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
     * Prepare event handler for hearing new incoming updates
     *
     * @param int $updateType
     * @param string $uri
     * @throws \Exception
     */
    public function hear(int $updateType = EventHandler::UPDATE_TYPE_WEBHOOK, string $uri = '/')
    {
        array_unshift($this->eventHandlers, static::$eventHandler);

        switch ($updateType) {
            case EventHandler::UPDATE_TYPE_WEBHOOK:
                Loop::run(function () {
                    $this->finish(uniqid());
                    $update = new Update(
                        json_decode(file_get_contents('php://input'), true)
                    );
                    array_map(
                        fn($eventHandler) => call(fn() => $eventHandler->boot($update)), $this->eventHandlers
                    );
                });
                break;
            case EventHandler::UPDATE_TYPE_POLLING:
                Loop::run(function () {
                    $offset = -1;
                    yield $this->deleteWebhook();

                    Loop::repeat(100, function () use (&$offset) {
                        $updates = yield $this->getUpdates($offset);

                        if (is_collection($updates) && $updates->isNotEmpty()) {
                            foreach ($updates as $update) {
                                array_map(
                                    fn($eventHandler) => call(fn() => $eventHandler->boot($update)), $this->eventHandlers
                                );
                                $offset = $update->update_id + 1;
                            }
                        }

                    });


                    Loop::onSignal(\SIGINT, function (string $watcherId) {
                        Loop::cancel($watcherId);
                        exit();
                    });
                });
                break;
            case EventHandler::UPDATE_TYPE_SOCKET_SERVER:
                Loop::run(function () use ($uri) {
                    $servers = [
                        Socket\Server::listen('0.0.0.0:8000'),
                        Socket\Server::listen('[::]:8000'),
                    ];

                    $logHandler = new StreamHandler(new ResourceOutputStream(\STDOUT));
                    $logHandler->setFormatter(new ConsoleFormatter);
                    $logger = new Logger('server');
                    $logger->pushHandler($logHandler);
                    $router = new Server\Router();

                    foreach (['GET', 'POST'] as $method)
                        $router->addRoute($method, $uri, Server\Middleware\stack(
                            new CallableRequestHandler(function (Server\Request $request) {
                                $update = new Update(
                                    json_decode(yield $request->getBody()->buffer(), true)
                                );
                                array_map(
                                    fn($eventHandler) => call(fn() => $eventHandler->boot($update)), $this->eventHandlers
                                );
                                return new Response(Status::OK);
                            }),
                            new AuthorizeWebhooks()
                        ));

                    $server = new Server\Server($servers, $router, $logger);

                    yield $server->start();

                    Loop::onSignal(\SIGINT, function (string $watcherId) use ($server) {
                        Loop::cancel($watcherId);
                        yield $server->stop();
                    });
                });
            default:
                throw new \Exception('Unsupported update handling type.');
        }
    }

    /**
     * Finish browser requests
     *
     * @param string $message
     * @return void
     */
    public function finish(string $message = 'HTTP OK')
    {
        while (ob_get_level() > 0)
            ob_end_clean();
        header('Connection: close');
        ignore_user_abort(true);
        ob_start();
        print $message;
        $size = ob_get_length();
        header("Content-Length: $size");
        header('Content-Type: application/json');
        ob_end_flush();
        flush();
        if (function_exists('litespeed_finish_request'))
            litespeed_finish_request();
        if (function_exists('fastcgi_finish_request'))
            fastcgi_finish_request();
    }

    /**
     * Set the event handler for avoiding updates
     *
     * @param $eventHandler
     * @return EventHandler
     * @throws \Exception
     */
    public function setEventHandler($eventHandler): EventHandler
    {
        if ($eventHandler instanceof EventHandler) {
            return $this->eventHandlers[] = $eventHandler;
        }

        throw new \Exception(sprintf(
            'The eventHandler must be instance of %s', EventHandler::class,
        ));

    }
}
