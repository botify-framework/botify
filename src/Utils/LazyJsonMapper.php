<?php

namespace Jove\Utils;

use Jove\TelegramAPI;

/**
 * LazyJsonMapper
 *
 * @property TelegramAPI $api
 */
class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper
{
    /**
     * @return TelegramAPI
     */
    public function getAPI(): TelegramAPI
    {
        return new TelegramAPI();
    }
}