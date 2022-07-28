<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * Dice
 *
 * @method string getEmoji()
 * @method Int getValue()
 *
 * @method bool isEmoji()
 * @method bool isValue()
 *
 * @method $this setEmoji(string $value)
 * @method $this setValue(int $value)
 *
 * @method $this unsetEmoji()
 * @method $this unsetValue()
 *
 * @property string $emoji
 * @property Int $value
 */
class Dice extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'emoji' => 'string',
        'value' => 'int',
    ];
}