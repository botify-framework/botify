<?php

namespace Botify\Traits;

use stdClass;
use function Botify\array_sole;
use function Botify\array_some;

trait Accessible
{
    protected ?stdClass $bagData = null;

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
        return array_sole($this->getBagData(), function ($bag) use ($name) {
            return $bag->{$name} ?? false;
        });
    }

    public function getBagData()
    {
        $data = $this->getAccessibles();
        $data[] = $this->bagData;
        return $data;
    }

    private function set(mixed $name, mixed $value)
    {
        $this->bagData ??= new stdClass();
        $this->bagData->{$name} = $value;
    }

    final public function __unset(string $name)
    {
        $this->unset($name);
    }

    private function unset(string $name)
    {
        foreach ($this->getBagData() as $bag) {
            unset($bag->{$name});
        }
    }

    abstract public function getAccessibles(): array;

    final public function offsetExists(mixed $offset): bool
    {
        return $this->isset($offset);
    }

    private function isset(string $name): bool
    {
        return array_some($this->getBagData(), fn($bag) => isset($bag[$name]));
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

    final public function resetBag()
    {
        $this->bagData = null;
    }
}