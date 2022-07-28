<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultLocation
 *
 * @method string getType()
 * @method string getId()
 * @method Float getLatitude()
 * @method Float getLongitude()
 * @method string getTitle()
 * @method Float getHorizontalAccuracy()
 * @method Int getLivePeriod()
 * @method Int getHeading()
 * @method Int getProximityAlertRadius()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method InputMessageContent getInputMessageContent()
 * @method string getThumbUrl()
 * @method Int getThumbWidth()
 * @method Int getThumbHeight()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isLatitude()
 * @method bool isLongitude()
 * @method bool isTitle()
 * @method bool isHorizontalAccuracy()
 * @method bool isLivePeriod()
 * @method bool isHeading()
 * @method bool isProximityAlertRadius()
 * @method bool isReplyMarkup()
 * @method bool isInputMessageContent()
 * @method bool isThumbUrl()
 * @method bool isThumbWidth()
 * @method bool isThumbHeight()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setLatitude(float $value)
 * @method $this setLongitude(float $value)
 * @method $this setTitle(string $value)
 * @method $this setHorizontalAccuracy(float $value)
 * @method $this setLivePeriod(int $value)
 * @method $this setHeading(int $value)
 * @method $this setProximityAlertRadius(int $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 * @method $this setThumbUrl(string $value)
 * @method $this setThumbWidth(int $value)
 * @method $this setThumbHeight(int $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetLatitude()
 * @method $this unsetLongitude()
 * @method $this unsetTitle()
 * @method $this unsetHorizontalAccuracy()
 * @method $this unsetLivePeriod()
 * @method $this unsetHeading()
 * @method $this unsetProximityAlertRadius()
 * @method $this unsetReplyMarkup()
 * @method $this unsetInputMessageContent()
 * @method $this unsetThumbUrl()
 * @method $this unsetThumbWidth()
 * @method $this unsetThumbHeight()
 *
 * @property string $type
 * @property string $id
 * @property Float $latitude
 * @property Float $longitude
 * @property string $title
 * @property Float $horizontal_accuracy
 * @property Int $live_period
 * @property Int $heading
 * @property Int $proximity_alert_radius
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 * @property string $thumb_url
 * @property Int $thumb_width
 * @property Int $thumb_height
 */
class InlineQueryResultLocation extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'latitude' => 'float',
        'longitude' => 'float',
        'title' => 'string',
        'horizontal_accuracy' => 'float',
        'live_period' => 'int',
        'heading' => 'int',
        'proximity_alert_radius' => 'int',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
        'thumb_url' => 'string',
        'thumb_width' => 'int',
        'thumb_height' => 'int',
    ];
}