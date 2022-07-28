<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * PassportElementErrorUnspecified
 *
 * @method string getSource()
 * @method string getType()
 * @method string getElementHash()
 * @method string getMessage()
 *
 * @method bool isSource()
 * @method bool isType()
 * @method bool isElementHash()
 * @method bool isMessage()
 *
 * @method $this setSource(string $value)
 * @method $this setType(string $value)
 * @method $this setElementHash(string $value)
 * @method $this setMessage(string $value)
 *
 * @method $this unsetSource()
 * @method $this unsetType()
 * @method $this unsetElementHash()
 * @method $this unsetMessage()
 *
 * @property string $source
 * @property string $type
 * @property string $element_hash
 * @property string $message
 */
class PassportElementErrorUnspecified extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'source' => 'string',
        'type' => 'string',
        'element_hash' => 'string',
        'message' => 'string',
    ];
}