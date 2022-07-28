<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * WebAppInfo
 *
 * @method string getUrl()
 *
 * @method bool isUrl()
 *
 * @method $this setUrl(string $value)
 *
 * @method $this unsetUrl()
 *
 * @property string $url
 */
class WebAppInfo extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'url' => 'string',
    ];
}