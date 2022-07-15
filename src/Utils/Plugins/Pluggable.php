<?php

namespace Jove\Utils\Plugins;

use Amp\Promise;
use Closure;
use Jove\TelegramAPI;
use Jove\Types\Update;
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
        return $this->getCallback()(... $args);
    }

    final public function getCallback(): callable
    {
        return coroutine($this->callback ?? [$this, 'handle']);
    }

    public function reset()
    {
        unset($this->api, $this->update);
    }
}