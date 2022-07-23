<?php

namespace Jove\Utils\Plugins;

use Amp\Promise;
use Closure;
use Jove\TelegramAPI;
use Jove\Types\Update;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionUnionType;
use function Amp\coroutine;

abstract class Pluggable
{
    public Update $update;
    private TelegramAPI $api;
    private $callback;
    private array $filters = [];

    final public function __construct(array $filters = [], ?callable $fn = null)
    {
        $this->filters = array_filter($filters, 'is_callable');
        $this->callback = $fn instanceof Closure
            ? $fn->bindTo($this)
            : $fn;
    }

    final public function __call($name, array $arguments = [])
    {
        return [$this->getApi(), $name](... $arguments);
    }

    /**
     * @return TelegramAPI
     */
    public function getApi(): TelegramAPI
    {
        return $this->api;
    }

    /**
     * @param TelegramAPI $api
     */
    public function setApi(TelegramAPI $api): void
    {
        $this->api = $api;
    }

    public function __get($name)
    {
        return $this->getUpdate()->{$name};
    }

    /**
     * @return Update
     */
    public function getUpdate(): Update
    {
        return $this->update;
    }

    /**
     * @param Update $update
     */
    public function setUpdate(Update $update): void
    {
        $this->update = $update;
    }

    /**
     * @return Promise
     */
    final public function applyFilters(): Promise
    {
        return gather(array_map(function ($filter) {
            return coroutine($filter)($this->api, $this->update);
        }, $this->getFilters()));
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     */
    public function setFilters(array $filters): void
    {
        $this->filters = array_merge($this->filters, $filters);
    }

    final public function call(...$args)
    {
        $callback = $this->getCallback();

        $reflector = new class($callback, $args[0]) {
            private ReflectionFunctionAbstract $reflection;
            private Update $update;

            public function __construct(callable $callback, Update $update)
            {
                $this->reflection = is_array($callback)
                    ? new ReflectionMethod(... $callback)
                    : new ReflectionFunction($callback);
                $this->update = $update;
            }

            public function getArguments(array &$arguments = []): bool
            {
                $parameters = $this->reflection->getParameters();

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
                            return $this->update->api;
                        } elseif ($value = $isEqual()) {
                            return $value;
                        }
                    })) {
                        $arguments[$index] = $value;
                    } else {
                        unset($parameters[$index]);
                    }
                }

                return $this->reflection->getNumberOfParameters() === count($parameters);
            }
        };

        if ($reflector->getArguments($args)) {
            return coroutine($callback)(... $args);
        }
    }

    final public function getCallback(): callable
    {
        return $this->callback ?? [$this, 'handle'];
    }

    public function reset()
    {
        unset($this->api, $this->update);
    }
}