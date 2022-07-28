<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * MenuButtonDefault
 *
 * @method string getType()
 *
 * @method bool isType()
 *
 * @method $this setType(string $value)
 *
 * @method $this unsetType()
 *
 * @property string $type
 */
class MenuButtonDefault extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
    ];
}