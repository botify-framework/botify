<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ShippingOption
 *
 * @method string getId()
 * @method string getTitle()
 * @method LabeledPrice[] getPrices()
 *
 * @method bool isId()
 * @method bool isTitle()
 * @method bool isPrices()
 *
 * @method $this setId(string $value)
 * @method $this setTitle(string $value)
 * @method $this setPrices(LabeledPrice[] $value)
 *
 * @method $this unsetId()
 * @method $this unsetTitle()
 * @method $this unsetPrices()
 *
 * @property string $id
 * @property string $title
 * @property LabeledPrice[] $prices
 */
class ShippingOption extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'title' => 'string',
        'prices' => 'LabeledPrice[]',
    ];
}