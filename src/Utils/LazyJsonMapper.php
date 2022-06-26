<?php

namespace Jove\Utils;

use ArrayAccess;
use Jove\TelegramAPI;

class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper implements ArrayAccess
{
    public TelegramAPI $api;

    /**
     * Initialize properties
     */
    public function _init()
    {
        parent::_init();

        $this->api = new TelegramAPI();
    }


    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->ok ?? true;
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

    public function collect(): Collection
    {
        return collect($this->toArray(), true);
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->_isProperty($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->_getProperty($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->_setProperty($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->_unsetProperty($offset);
    }
}