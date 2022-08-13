<?php

namespace Botify;

use Amp\ByteStream\ResourceOutputStream;
use Amp\Http\Server;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Loop;
use Amp\Promise;
use Amp\Redis\Config;
use Amp\Redis\Redis;
use Amp\Redis\RemoteExecutor;
use Amp\Socket;
use ArrayAccess;
use Botify\Events\Handler;
use Botify\Methods\MethodsFactory;
use Botify\Request\Client;
use Botify\Traits\Accessible;
use Botify\Types\Update;
use Botify\Utils\LazyJsonMapper;
use Botify\Utils\Logger\Logger;
use Botify\Utils\Plugins\Plugin;
use Closure;
use Exception;
use stdClass;
use function Amp\call;
use function Amp\coroutine;
use function Amp\File\createSymlink;
use function Amp\File\isSymlink;
use const SIGINT;

/**
 * @mixin Methods\MethodsFactory
 */
class TelegramAPI implements ArrayAccess
{
    use Accessible;

    protected Client $client;
    protected Utils\Logger\Logger $logger;
    protected ?Redis $redis;
    private array $initiators = [];
    private MethodsFactory $methodFactory;
    private Plugin $plugin;
    private bool $runningInLoop = false;
    private stdClass $uses;

    public function __construct(array $config = [])
    {
        config([
            'telegram' => array_merge(
                config('telegram', []), $config
            )
        ]);
        config(['telegram.bot_user_id' => (int)array_first(explode(':', config('telegram.token')))]);
        $this->enableRedis();
        LazyJsonMapper::setAPI($this);
        $this->logger = new Utils\Logger\Logger(config('app.logger_level'), config('app.logger_type'));
        $this->client = new Client();
        $this->methodFactory = new MethodsFactory($this);
        $this->plugin = Plugin::factory(config('telegram.plugins_dir'));
        $this->uses = new stdClass();
    }

    private function enableRedis(): void
    {
        $config = config('redis');

        if (isset($config['host']) && isset($config['port'])) {
            $uri = Config::fromUri('redis://' . $config['host'] . ':' . $config['port'] . '?' . http_build_query([
                    'password' => $config['password'] ?? '',
                    'timeout' => $config['timeout'] ?? '',
                    'database' => $config['database'] ?? 0,
                ]));
            $this->redis = new Redis(new RemoteExecutor($uri));
        }

    }

    public static function factory(array $config = []): TelegramAPI
    {
        return new static($config);
    }

    /**
     * Dynamic proxy Telegram methods
     *
     * @param string $name
     * @param array $arguments
     * @return Promise
     * @throws Exception
     */
    public function __call(string $name, array $arguments = [])
    {
        return call_user_func_array([$this->methodFactory, $name], $arguments);
    }

    public function call(callable $callback, ...$args): Promise
    {
        return call($callback, ... $args);
    }

    public function getAccessibles(): array
    {
        return [$this->uses];
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getInitiators(): array
    {
        return $this->initiators;
    }

    public function getLogger(): Utils\Logger\Logger
    {
        return $this->logger;
    }

    public function getPlugin(): Plugin
    {
        return $this->plugin;
    }

    public function getRedis(): ?Redis
    {
        return $this->redis;
    }

    public function loopAndHear($updateType = Handler::UPDATE_TYPE_WEBHOOK)
    {
        $this->loop(function () use ($updateType) {
            yield $this->hear($updateType);
        });
    }

    public function loop(Closure|TelegramAPI $callback)
    {
        $this->runningInLoop = true;

        Loop::run(function (...$args) use ($callback) {
            if ($callback instanceof Closure) {
                $callback = $callback->bindTo($this);
            }

            yield call($callback, ... $args);
        });
    }

    /**
     * Prepare event handler for hearing new incoming updates
     *
     * @param int $updateType
     * @param string $uri
     */
    public function hear(int $updateType = Handler::UPDATE_TYPE_WEBHOOK, string $uri = '/')
    {
        $container = coroutine($this->runningInLoop ? '\\Amp\\call' : [Loop::class, 'run']);

        return $container(function () use ($updateType, $uri) {
            $forceRunIn = function ($mode) {
                $isCli = env('APP_RUNNING_IN_CONSOLE') || in_array(PHP_SAPI, ['cli', 'php-dbg']);

                switch ($mode) {
                    case 'cli':
                        if (!$isCli) {
                            throw new Exception('You must use this type in cli');
                        }
                        break;
                    case 'browser':
                        if ($isCli) {
                            throw new Exception('You must use this type in cli');
                        }
                }
            };
            (yield isSymlink($staticPath = rtrim(static_path(), '/'))) ?: yield createSymlink(storage_path('/static'), $staticPath);

            switch ($updateType) {
                case Handler::UPDATE_TYPE_WEBHOOK:
                    $forceRunIn('browser');
                    if ('production' === strtolower(config('app.environment')) && $secureToken = config('telegram.secret_token')) {
                        $headers = getallheaders();

                        if (isset($headers['X-Telegram-Bot-Api-Secret-Token']) && $secureToken !== $headers['X-Telegram-Bot-Api-Secret-Token']) {
                            header('Content-Type: application/json;charset=utf-8');
                            http_response_code(403);
                            die(json_encode([
                                'success' => false,
                                'message' => 'You are not allowed.',
                            ]));
                        }
                    }

                    $this->finish();
                    $update = new Update(json_decode(yield file_get_contents('php://input'), true) ?? []);
                    yield Handler::dispatch($update);
                    break;
                case Handler::UPDATE_TYPE_POLLING:
                    $forceRunIn('cli');
                    $offset = -1;
                    yield $this->deleteWebhook();
                    $allowedUpdates = config('telegram.allowed_updates', []);

                    Loop::repeat(config('telegram.loop_interval'), function () use ($allowedUpdates, &$offset) {
                        $updates = yield $this->getUpdates($offset, allowed_updates: $allowedUpdates);

                        if (is_collection($updates) && $updates->isNotEmpty()) {
                            foreach ($updates as $update) {
                                Handler::dispatch($update);

                                $offset = $update->update_id + 1;
                            }
                        }

                    });

                    Loop::onSignal(SIGINT, function (string $watcherId) {
                        Loop::cancel($watcherId);
                        exit();
                    });
                    break;
                case Handler::UPDATE_TYPE_SOCKET_SERVER:
                    $options = getopt('d::', [
                        'drop_pending_updates::'
                    ]);

                    yield $this->resetWebhook([
                        'drop_pending_updates' => (bool)($options['d'] ?? $options['drop_pending_updates'] ?? false),
                        'allowed_updates' => config('telegram.allowed_updates', [])
                    ]);

                    $forceRunIn('cli');

                    $host = config('telegram.socket_server.host');
                    $port = config('telegram.socket_server.port');

                    $servers = [
                        Socket\Server::listen("$host:$port"),
                        Socket\Server::listen('[::]:' . $port),
                    ];

                    $logger = new Logger();
                    $router = new Server\Router();
                    $router->setFallback(new Server\StaticContent\DocumentRoot(static_path()));

                    $middleware = new class implements Server\Middleware {
                        public function handleRequest(Request $request, RequestHandler $requestHandler): Promise
                        {
                            /**
                             * In the latest version of telegram the "secret_token" field was added when setting the webhook.
                             * This middleware can help you to authorize your with secret_token.
                             */
                            return call(function () use ($request, $requestHandler) {
                                $next = fn() => $requestHandler->handleRequest($request, $requestHandler);

                                if ('production' === strtolower(config('app.environment')) && $secureToken = config('telegram.secret_token')) {
                                    return $request->getHeader('X-Telegram-Bot-Api-Secret-Token') === $secureToken ? $next() : new Response(403, [
                                        'Content-Type' => 'application/json;charset=utf-8'
                                    ], json_encode([
                                        'success' => false,
                                        'message' => 'You are not allowed.',
                                    ]));

                                }

                                return $next();
                            });
                        }
                    };
                    $handler = Server\Middleware\stack(
                        new CallableRequestHandler(function (Server\Request $request) {
                            $update = new Update(
                                json_decode(yield $request->getBody()->buffer(), true) ?? []
                            );
                            Handler::dispatch($update);
                            return new Response(Status::OK, stringOrStream: 'HTTP Ok');
                        }),
                        $middleware
                    );

                    foreach (['GET', 'POST'] as $method)
                        $router->addRoute($method, $uri, $handler);

                    $server = new Server\HttpServer($servers, $router, $logger);

                    yield $server->start();

                    Loop::onSignal(SIGINT, function (string $watcherId) use ($server) {
                        Loop::cancel($watcherId);
                        yield $server->stop();
                    });
                    break;
                default:
                    throw new Exception('Unsupported update handling type.');
            }
        });
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
        @header('Connection: close');
        ignore_user_abort(true);
        ob_start();
        print $message;
        $size = ob_get_length();
        @header("Content-Length: $size");
        @header('Content-Type: application/json');
        ob_end_flush();
        flush();
        if (function_exists('litespeed_finish_request'))
            litespeed_finish_request();
        if (function_exists('fastcgi_finish_request'))
            fastcgi_finish_request();
    }

    /**
     * A decorator for defining events
     *
     * @return void
     */
    public function on()
    {
        Handler::addHandler(... func_get_args());
    }

    public function onBefore(...$initiators)
    {
        $this->initiators += $initiators;
    }

    /**
     * Set the event handler for avoiding updates
     *
     * @param $eventHandler
     * @return void
     */
    public function setEventHandler($eventHandler)
    {
        Handler::addHandler($eventHandler);
    }

    public function use($name, $value)
    {
        $this->uses->{$name} = $value;
    }
}
