<?php

namespace Jove\Utils;

use Jove\TelegramAPI;

class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper
{
    public bool $ok;

    public TelegramAPI $api;

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
}