<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * Invoice
 *
 * @method string getTitle()
 * @method string getDescription()
 * @method string getStartParameter()
 * @method string getCurrency()
 * @method Int getTotalAmount()
 *
 * @method bool isTitle()
 * @method bool isDescription()
 * @method bool isStartParameter()
 * @method bool isCurrency()
 * @method bool isTotalAmount()
 *
 * @method $this setTitle(string $value)
 * @method $this setDescription(string $value)
 * @method $this setStartParameter(string $value)
 * @method $this setCurrency(string $value)
 * @method $this setTotalAmount(int $value)
 *
 * @method $this unsetTitle()
 * @method $this unsetDescription()
 * @method $this unsetStartParameter()
 * @method $this unsetCurrency()
 * @method $this unsetTotalAmount()
 *
 * @property string $title
 * @property string $description
 * @property string $start_parameter
 * @property string $currency
 * @property Int $total_amount
 */
class Invoice extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'title' => 'string',
        'description' => 'string',
        'start_parameter' => 'string',
        'currency' => 'string',
        'total_amount' => 'int',
    ];
}