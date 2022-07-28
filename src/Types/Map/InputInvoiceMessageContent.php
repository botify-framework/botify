<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputInvoiceMessageContent
 *
 * @method string getTitle()
 * @method string getDescription()
 * @method string getPayload()
 * @method string getProviderToken()
 * @method string getCurrency()
 * @method LabeledPrice[] getPrices()
 * @method Int getMaxTipAmount()
 * @method int[] getSuggestedTipAmounts()
 * @method string getProviderData()
 * @method string getPhotoUrl()
 * @method Int getPhotoSize()
 * @method Int getPhotoWidth()
 * @method Int getPhotoHeight()
 * @method bool getNeedName()
 * @method bool getNeedPhoneNumber()
 * @method bool getNeedEmail()
 * @method bool getNeedShippingAddress()
 * @method bool getSendPhoneNumberToProvider()
 * @method bool getSendEmailToProvider()
 * @method bool getIsFlexible()
 *
 * @method bool isTitle()
 * @method bool isDescription()
 * @method bool isPayload()
 * @method bool isProviderToken()
 * @method bool isCurrency()
 * @method bool isPrices()
 * @method bool isMaxTipAmount()
 * @method bool isSuggestedTipAmounts()
 * @method bool isProviderData()
 * @method bool isPhotoUrl()
 * @method bool isPhotoSize()
 * @method bool isPhotoWidth()
 * @method bool isPhotoHeight()
 * @method bool isNeedName()
 * @method bool isNeedPhoneNumber()
 * @method bool isNeedEmail()
 * @method bool isNeedShippingAddress()
 * @method bool isSendPhoneNumberToProvider()
 * @method bool isSendEmailToProvider()
 * @method bool isIsFlexible()
 *
 * @method $this setTitle(string $value)
 * @method $this setDescription(string $value)
 * @method $this setPayload(string $value)
 * @method $this setProviderToken(string $value)
 * @method $this setCurrency(string $value)
 * @method $this setPrices(LabeledPrice[] $value)
 * @method $this setMaxTipAmount(int $value)
 * @method $this setSuggestedTipAmounts(int[] $value)
 * @method $this setProviderData(string $value)
 * @method $this setPhotoUrl(string $value)
 * @method $this setPhotoSize(int $value)
 * @method $this setPhotoWidth(int $value)
 * @method $this setPhotoHeight(int $value)
 * @method $this setNeedName(bool $value)
 * @method $this setNeedPhoneNumber(bool $value)
 * @method $this setNeedEmail(bool $value)
 * @method $this setNeedShippingAddress(bool $value)
 * @method $this setSendPhoneNumberToProvider(bool $value)
 * @method $this setSendEmailToProvider(bool $value)
 * @method $this setIsFlexible(bool $value)
 *
 * @method $this unsetTitle()
 * @method $this unsetDescription()
 * @method $this unsetPayload()
 * @method $this unsetProviderToken()
 * @method $this unsetCurrency()
 * @method $this unsetPrices()
 * @method $this unsetMaxTipAmount()
 * @method $this unsetSuggestedTipAmounts()
 * @method $this unsetProviderData()
 * @method $this unsetPhotoUrl()
 * @method $this unsetPhotoSize()
 * @method $this unsetPhotoWidth()
 * @method $this unsetPhotoHeight()
 * @method $this unsetNeedName()
 * @method $this unsetNeedPhoneNumber()
 * @method $this unsetNeedEmail()
 * @method $this unsetNeedShippingAddress()
 * @method $this unsetSendPhoneNumberToProvider()
 * @method $this unsetSendEmailToProvider()
 * @method $this unsetIsFlexible()
 *
 * @property string $title
 * @property string $description
 * @property string $payload
 * @property string $provider_token
 * @property string $currency
 * @property LabeledPrice[] $prices
 * @property Int $max_tip_amount
 * @property int[] $suggested_tip_amounts
 * @property string $provider_data
 * @property string $photo_url
 * @property Int $photo_size
 * @property Int $photo_width
 * @property Int $photo_height
 * @property bool $need_name
 * @property bool $need_phone_number
 * @property bool $need_email
 * @property bool $need_shipping_address
 * @property bool $send_phone_number_to_provider
 * @property bool $send_email_to_provider
 * @property bool $is_flexible
 */
class InputInvoiceMessageContent extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'title' => 'string',
        'description' => 'string',
        'payload' => 'string',
        'provider_token' => 'string',
        'currency' => 'string',
        'prices' => 'LabeledPrice[]',
        'max_tip_amount' => 'int',
        'suggested_tip_amounts' => 'int[]',
        'provider_data' => 'string',
        'photo_url' => 'string',
        'photo_size' => 'int',
        'photo_width' => 'int',
        'photo_height' => 'int',
        'need_name' => 'bool',
        'need_phone_number' => 'bool',
        'need_email' => 'bool',
        'need_shipping_address' => 'bool',
        'send_phone_number_to_provider' => 'bool',
        'send_email_to_provider' => 'bool',
        'is_flexible' => 'bool',
    ];
}