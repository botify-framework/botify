<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * PreCheckoutQuery
 *
 * @method string getId()
 * @method User getFrom()
 * @method string getCurrency()
 * @method Int getTotalAmount()
 * @method string getInvoicePayload()
 * @method string getShippingOptionId()
 * @method OrderInfo getOrderInfo()
 *
 * @method bool isId()
 * @method bool isFrom()
 * @method bool isCurrency()
 * @method bool isTotalAmount()
 * @method bool isInvoicePayload()
 * @method bool isShippingOptionId()
 * @method bool isOrderInfo()
 *
 * @method $this setId(string $value)
 * @method $this setFrom(User $value)
 * @method $this setCurrency(string $value)
 * @method $this setTotalAmount(int $value)
 * @method $this setInvoicePayload(string $value)
 * @method $this setShippingOptionId(string $value)
 * @method $this setOrderInfo(OrderInfo $value)
 *
 * @method $this unsetId()
 * @method $this unsetFrom()
 * @method $this unsetCurrency()
 * @method $this unsetTotalAmount()
 * @method $this unsetInvoicePayload()
 * @method $this unsetShippingOptionId()
 * @method $this unsetOrderInfo()
 *
 * @property string $id
 * @property User $from
 * @property string $currency
 * @property Int $total_amount
 * @property string $invoice_payload
 * @property string $shipping_option_id
 * @property OrderInfo $order_info
 */
class PreCheckoutQuery extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'from' => 'User',
        'currency' => 'string',
        'total_amount' => 'int',
        'invoice_payload' => 'string',
        'shipping_option_id' => 'string',
        'order_info' => 'OrderInfo',
    ];
}