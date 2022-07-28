<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ShippingAddress
 *
 * @method string getCountryCode()
 * @method string getState()
 * @method string getCity()
 * @method string getStreetLine1()
 * @method string getStreetLine2()
 * @method string getPostCode()
 *
 * @method bool isCountryCode()
 * @method bool isState()
 * @method bool isCity()
 * @method bool isStreetLine1()
 * @method bool isStreetLine2()
 * @method bool isPostCode()
 *
 * @method $this setCountryCode(string $value)
 * @method $this setState(string $value)
 * @method $this setCity(string $value)
 * @method $this setStreetLine1(string $value)
 * @method $this setStreetLine2(string $value)
 * @method $this setPostCode(string $value)
 *
 * @method $this unsetCountryCode()
 * @method $this unsetState()
 * @method $this unsetCity()
 * @method $this unsetStreetLine1()
 * @method $this unsetStreetLine2()
 * @method $this unsetPostCode()
 *
 * @property string $country_code
 * @property string $state
 * @property string $city
 * @property string $street_line1
 * @property string $street_line2
 * @property string $post_code
 */
class ShippingAddress extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'country_code' => 'string',
        'state' => 'string',
        'city' => 'string',
        'street_line1' => 'string',
        'street_line2' => 'string',
        'post_code' => 'string',
    ];
}