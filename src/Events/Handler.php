<?php

namespace Botify\Events;

use Amp\Promise;
use Amp\Success;
use Botify\TelegramAPI;
use Botify\Types\Update;
use Botify\Utils\Bag;
use Closure;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionUnionType;
use Throwable;
use function Amp\call;
use function Amp\coroutine;
use function Botify\{array_sole, gather};

class Handler
{
    const UPDATE_TYPE_WEBHOOK = 1;
    const UPDATE_TYPE_POLLING = 2;
    const UPDATE_TYPE_SOCKET_SERVER = 3;

    public static array $eventHandlers = [];

    public static function addHandler()
    {
        [$listeners, $handler] = array_pad(func_get_args(), -2, null);

        if (!is_null($listeners) && $handler instanceof Closure) {
            foreach ((array)$listeners as $listener) {
                static::$eventHandlers[strtolower($listener)] = $handler;
            }
        } else {
            if ($handler instanceof Closure) {
                static::$eventHandlers['any'] = $handler;
            } else {
                static::$eventHandlers[] = $handler;
            }
        }
    }

    public static function dispatch(Update $update): Promise
    {
        return call(function () use ($update) {
            $reflector = new class($update) {

                public function __construct(private Update $update)
                {
                }

                public function bindCallback(callable $callback, array $arguments = [])
                {
                    $reflection = is_array($callback)
                        ? new ReflectionMethod(... $callback)
                        : new ReflectionFunction($callback);
                    $parameters = $reflection->getParameters();

                    foreach ($parameters as $index => $parameter) {
                        $types = $parameter->getType() instanceof ReflectionUnionType
                            ? $parameter->getType()->getTypes()
                            : [$parameter->getType()];

                        if ($value = array_sole($types, function ($type) {
                            $name = $type->getName();

                            $isEqual = function () use ($name) {
                                foreach ($this->update::JSON_PROPERTY_MAP as $index => $item) {
                                    if (str_ends_with($name, $item) && isset($this->update[$index])) {
                                        return $this->update[$index];
                                    }
                                }

                                return false;
                            };

                            if ($name === get_class($this->update)) {
                                return $this->update;
                            } elseif ($name === TelegramAPI::class) {
                                return $this->update->getAPI();
                            } elseif ($value = $isEqual()) {
                                return $value;
                            }
                        })) {
                            $arguments[$index] = $value;
                        } else {
                            unset($parameters[$index]);
                        }
                    }

                    if ($reflection->getNumberOfParameters() === count($parameters)) {
                        return coroutine($callback)(... $arguments);
                    }

                    return new Success();
                }
            };
            $bag = new Bag();
            $bag->setAPI($update->getAPI());
            $promises = [];

            foreach ($update->getAPI()->getInitiators() as $initiator) {
                if ($initiator instanceof Closure) {
                    $promises[] = $reflector->bindCallback($initiator->bindTo($bag));
                }
            }

            try {
                yield gather($promises);
            } catch (Throwable $e) {
                return $update->getAPI()->getLogger()->critical($e);
            }

            $privateHandler = new class extends EventHandler {
            };
            $privateHandler->register($update, $bag);
            $plugins = $update->getAPI()
                ->getPlugin()
                ->withUpdate($update)
                ->withBag($bag)
                ->withReflector($reflector);
            $promises = [$plugins->wait()];

            foreach (static::$eventHandlers as $listener => $handler) {
                if ($handler instanceof Closure) {
                    if ($listener === 'any') {
                        $privateHandler = clone $privateHandler;
                        $promises[] = $reflector->bindCallback($handler->bindTo($privateHandler));
                    } elseif ($listener === 'mention') {
                        $privateHandler = clone $privateHandler;
                        $promises[] = $privateHandler->handleMention($handler);
                    } elseif (isset($update[$listener])) {
                        $privateHandler = clone $privateHandler;
                        $privateHandler->current = $update[$listener];
                        $promises[] = call($handler->bindTo($privateHandler), $privateHandler->current);
                    }
                } elseif ($handler instanceof EventHandler) {
                    $handler = $handler->register($update, $bag);

                    $promises[] = call(function () use ($update, $handler, $reflector) {
                        if (!$handler->tapStarted()) {
                            yield $reflector->bindCallback([$handler, 'onStart']);
                        }

                        yield gather([
                            call([$handler, 'onAny'], $update),
                            $handler->fire()
                        ]);
                    });
                }
            }

            try {
                yield gather($promises);
            } catch (Throwable $e) {
                $update->getAPI()->getLogger()->critical($e);
            }

            unset($bag, $privateHandler, $plugins);
        });
    }
}