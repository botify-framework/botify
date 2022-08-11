<?php

namespace Botify\Utils\Plugins;

use ArrayAccess;
use Botify\TelegramAPI;
use Botify\Traits\Accessible;
use Botify\Types\Update;
use Botify\Utils\Bag;
use Botify\Utils\Plugins\Exceptions\ContinuePropagation;
use Botify\Utils\Plugins\Exceptions\StopPropagation;
use Closure;

abstract class Pluggable implements ArrayAccess
{
    use Accessible;

    public ?Update $update;
    private ?TelegramAPI $api;
    private ?Bag $bag;
    private $callback;
    private array $filters;
    private int $priority;

    final public function __construct(array $filters = [], ?callable $fn = null, int $priority = 0)
    {
        $this->filters = array_filter($filters, 'is_callable');
        $this->callback = $fn instanceof Closure
            ? $fn->bindTo($this)
            : $fn;
        $this->priority = $priority;
    }

    final public function __call($name, array $arguments = [])
    {
        return [$this->update->getAPI(), $name](... $arguments);
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

    public function close()
    {
        $this->api = null;
        $this->update = null;
        $this->bag = null;
        $this->resetBag();
    }

    public function continuePropagation()
    {
        throw new ContinuePropagation();
    }

    public function getAPI(): ?TelegramAPI
    {
        return $this->api;
    }

    public function setAPI(TelegramAPI $api)
    {
        $this->api = $api;
    }

    public function getAccessibles(): array
    {
        return [$this->api, $this->update, $this->bag];
    }

    final public function getCallback(): callable
    {
        return $this->callback ?? [$this, 'handle'];
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): Pluggable
    {
        $this->priority = $priority;

        return $this;
    }

    public function setBag(Bag $bag)
    {
        $this->bag = $bag;
    }

    /**
     * @param Update $update
     */
    public function setUpdate(Update $update): void
    {
        $this->update = $update;
    }

    public function stopPropagation()
    {
        throw new StopPropagation();
    }
}