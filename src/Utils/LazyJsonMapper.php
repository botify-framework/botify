<?php

namespace Jove\Utils;

use Jove\TelegramAPI;

class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper
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
}