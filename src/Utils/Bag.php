<?php

namespace Botify\Utils;

use ArrayAccess;
use Botify\TelegramAPI;

class Bag implements ArrayAccess
{
    protected array $attributes = [];
    private TelegramAPI $api;

    public function __call($method, array $arguments = [])
    {
        return $this->api->{$method}(... $arguments);
    }

    public function __get(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set(string $name, mixed $value)
    {
        $this->attributes[$name] = $value;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->attributes[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->attributes[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_null($offset)) {
            $this->attributes[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->attributes[$offset]);
    }

    public function setAPI(TelegramAPI $api): Bag
    {
        $this->api = $api;

        return $this;
    }
}