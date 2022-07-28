<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputContactMessageContent
 *
 * @method string getPhoneNumber()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getVcard()
 *
 * @method bool isPhoneNumber()
 * @method bool isFirstName()
 * @method bool isLastName()
 * @method bool isVcard()
 *
 * @method $this setPhoneNumber(string $value)
 * @method $this setFirstName(string $value)
 * @method $this setLastName(string $value)
 * @method $this setVcard(string $value)
 *
 * @method $this unsetPhoneNumber()
 * @method $this unsetFirstName()
 * @method $this unsetLastName()
 * @method $this unsetVcard()
 *
 * @property string $phone_number
 * @property string $first_name
 * @property string $last_name
 * @property string $vcard
 */
class InputContactMessageContent extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'phone_number' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'vcard' => 'string',
    ];
}