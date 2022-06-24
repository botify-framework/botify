<?php

namespace Jove\Utils;

use Jove\TelegramAPI;

class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper
{
    public bool $ok;

    public TelegramAPI $api;

    /**
     * Initialize properties
     */
    public function _init()
    {
        parent::_init();

        $this->api = new TelegramAPI();
        $this->ok = true;
    }

    /**
     * Useful for responses
     *
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->ok;
    }

    /**
     * Alias of isOk
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isOk();
    }

    /**
     * Converting to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return json_decode((string)$this, true);
    }
}