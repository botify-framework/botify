<?php

namespace Botify\Utils\Plugins;

use Botify\TelegramAPI;
use Botify\Types\Update;
use Botify\Utils\DataBag;
use Closure;

abstract class Pluggable
{
    public Update $update;
    private TelegramAPI $api;
    private DataBag $bag;
    private $callback;
    private array $filters;

    final public function __construct(array $filters = [], ?callable $fn = null)
    {
        $this->filters = array_filter($filters, 'is_callable');
        $this->callback = $fn instanceof Closure
            ? $fn->bindTo($this)
            : $fn;
    }

    final public function __call($name, array $arguments = [])
    {
        return [$this->update->getAPI(), $name](... $arguments);
    }

    final public function __get($name)
    {
        return $this->bag[$name];
    }

    /**
     * @param Update $update
     */
    public function setUpdate(Update $update): void
    {
        $this->update = $update;
    }

    public function setBag(DataBag $bag)
    {
        $this->bag = $bag;
    }

    /**
     * Add new filter
     *
     * @param callable $filter
     * @return Pluggable
     */
    public function addFilter(callable $filter): Pluggable
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
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