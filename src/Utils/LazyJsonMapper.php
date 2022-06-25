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
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->_getProperty('ok');
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

    public function collect(): Collection
    {
        return collect($this->toArray(), true);
    }
}