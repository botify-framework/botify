<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * OrderInfo
 *
 * @method string getName()
 * @method string getPhoneNumber()
 * @method string getEmail()
 * @method ShippingAddress getShippingAddress()
 *
 * @method bool isName()
 * @method bool isPhoneNumber()
 * @method bool isEmail()
 * @method bool isShippingAddress()
 *
 * @method $this setName(string $value)
 * @method $this setPhoneNumber(string $value)
 * @method $this setEmail(string $value)
 * @method $this setShippingAddress(ShippingAddress $value)
 *
 * @method $this unsetName()
 * @method $this unsetPhoneNumber()
 * @method $this unsetEmail()
 * @method $this unsetShippingAddress()
 *
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property ShippingAddress $shipping_address
 */
class OrderInfo extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'name' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'shipping_address' => 'ShippingAddress',
    ];
}