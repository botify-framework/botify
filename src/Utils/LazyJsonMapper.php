<?php

namespace Botify\Utils;

use ArrayAccess;
use Botify\TelegramAPI;

class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper implements ArrayAccess
{
    private static TelegramAPI $api;

    public function setApi(TelegramAPI $api)
    {
        static::$api ??= $api;
    }

    public function getAPI(): TelegramAPI
    {
        return static::$api;
    }

    /**
     * Convert correct object to collection
     *
     * @return Collection
     */
    public function collect(): Collection
    {
        return collect($this->toArray(), true);
    }

    /**
     * Converting to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->asArray();
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->ok ?? true;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->_isProperty($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->_getProperty($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->_setProperty($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->_unsetProperty($offset);
    }
}