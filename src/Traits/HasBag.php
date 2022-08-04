<?php

namespace Botify\Traits;

use function Botify\array_sole;
use function Botify\array_some;

trait HasBag
{
    final public function __get(string $name)
    {
        return $this->get($name);
    }

    final public function __set(mixed $name, mixed $value)
    {
        $this->set($name, $value);
    }

    private function get(string $name)
    {
        return array_sole($this->getBag(), function ($bag) use ($name) {
            return $bag[$name] ?? false;
        });
    }

    private function set(mixed $name, mixed $value)
    {
        foreach ($this->getBag() as &$bag) {
            $bag[$name] = $value;
        }
    }

    final public function __unset(string $name)
    {
        $this->unset($name);
    }

    private function unset(string $name)
    {
        foreach ($this->getBag() as $bag) {
            unset($bag[$name]);
        }
    }

    abstract public function getBag(): array;

    final public function offsetExists(mixed $offset): bool
    {
        return $this->isset($offset);
    }

    private function isset(string $name): bool
    {
        return array_some($this->getBag(), fn($bag) => isset($bag[$name]));
    }

    final public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    final public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }

    final public function offsetUnset(mixed $offset): void
    {
        $this->unset($offset);
    }
}