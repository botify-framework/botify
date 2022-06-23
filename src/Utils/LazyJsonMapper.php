<?php

namespace Jove\Utils;

use Jove\TelegramAPI;

class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper
{
    public TelegramAPI $api;

    public function _init()
    {
        parent::_init();

        $this->api = new TelegramAPI();
    }
}