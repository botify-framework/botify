<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ShippingQuery
 *
 * @method string getId()
 * @method User getFrom()
 * @method string getInvoicePayload()
 * @method ShippingAddress getShippingAddress()
 *
 * @method bool isId()
 * @method bool isFrom()
 * @method bool isInvoicePayload()
 * @method bool isShippingAddress()
 *
 * @method $this setId(string $value)
 * @method $this setFrom(User $value)
 * @method $this setInvoicePayload(string $value)
 * @method $this setShippingAddress(ShippingAddress $value)
 *
 * @method $this unsetId()
 * @method $this unsetFrom()
 * @method $this unsetInvoicePayload()
 * @method $this unsetShippingAddress()
 *
 * @property string $id
 * @property User $from
 * @property string $invoice_payload
 * @property ShippingAddress $shipping_address
 */
class ShippingQuery extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'from' => 'User',
        'invoice_payload' => 'string',
        'shipping_address' => 'ShippingAddress',
    ];
}