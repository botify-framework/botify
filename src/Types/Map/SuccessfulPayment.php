<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * SuccessfulPayment
 *
 * @method string getCurrency()
 * @method Int getTotalAmount()
 * @method string getInvoicePayload()
 * @method string getShippingOptionId()
 * @method OrderInfo getOrderInfo()
 * @method string getTelegramPaymentChargeId()
 * @method string getProviderPaymentChargeId()
 *
 * @method bool isCurrency()
 * @method bool isTotalAmount()
 * @method bool isInvoicePayload()
 * @method bool isShippingOptionId()
 * @method bool isOrderInfo()
 * @method bool isTelegramPaymentChargeId()
 * @method bool isProviderPaymentChargeId()
 *
 * @method $this setCurrency(string $value)
 * @method $this setTotalAmount(int $value)
 * @method $this setInvoicePayload(string $value)
 * @method $this setShippingOptionId(string $value)
 * @method $this setOrderInfo(OrderInfo $value)
 * @method $this setTelegramPaymentChargeId(string $value)
 * @method $this setProviderPaymentChargeId(string $value)
 *
 * @method $this unsetCurrency()
 * @method $this unsetTotalAmount()
 * @method $this unsetInvoicePayload()
 * @method $this unsetShippingOptionId()
 * @method $this unsetOrderInfo()
 * @method $this unsetTelegramPaymentChargeId()
 * @method $this unsetProviderPaymentChargeId()
 *
 * @property string $currency
 * @property Int $total_amount
 * @property string $invoice_payload
 * @property string $shipping_option_id
 * @property OrderInfo $order_info
 * @property string $telegram_payment_charge_id
 * @property string $provider_payment_charge_id
 */
class SuccessfulPayment extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'currency' => 'string',
        'total_amount' => 'int',
        'invoice_payload' => 'string',
        'shipping_option_id' => 'string',
        'order_info' => 'OrderInfo',
        'telegram_payment_charge_id' => 'string',
        'provider_payment_charge_id' => 'string',
    ];
}