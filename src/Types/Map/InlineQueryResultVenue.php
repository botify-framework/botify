<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultVenue
 *
 * @method string getType()
 * @method string getId()
 * @method Float getLatitude()
 * @method Float getLongitude()
 * @method string getTitle()
 * @method string getAddress()
 * @method string getFoursquareId()
 * @method string getFoursquareType()
 * @method string getGooglePlaceId()
 * @method string getGooglePlaceType()
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
 * @method bool isAddress()
 * @method bool isFoursquareId()
 * @method bool isFoursquareType()
 * @method bool isGooglePlaceId()
 * @method bool isGooglePlaceType()
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
 * @method $this setAddress(string $value)
 * @method $this setFoursquareId(string $value)
 * @method $this setFoursquareType(string $value)
 * @method $this setGooglePlaceId(string $value)
 * @method $this setGooglePlaceType(string $value)
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
 * @method $this unsetAddress()
 * @method $this unsetFoursquareId()
 * @method $this unsetFoursquareType()
 * @method $this unsetGooglePlaceId()
 * @method $this unsetGooglePlaceType()
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
 * @property string $address
 * @property string $foursquare_id
 * @property string $foursquare_type
 * @property string $google_place_id
 * @property string $google_place_type
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 * @property string $thumb_url
 * @property Int $thumb_width
 * @property Int $thumb_height
 */
class InlineQueryResultVenue extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'latitude' => 'float',
        'longitude' => 'float',
        'title' => 'string',
        'address' => 'string',
        'foursquare_id' => 'string',
        'foursquare_type' => 'string',
        'google_place_id' => 'string',
        'google_place_type' => 'string',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
        'thumb_url' => 'string',
        'thumb_width' => 'int',
        'thumb_height' => 'int',
    ];
}