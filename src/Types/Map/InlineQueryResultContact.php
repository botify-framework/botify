<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultContact
 *
 * @method string getType()
 * @method string getId()
 * @method string getPhoneNumber()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getVcard()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method InputMessageContent getInputMessageContent()
 * @method string getThumbUrl()
 * @method Int getThumbWidth()
 * @method Int getThumbHeight()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isPhoneNumber()
 * @method bool isFirstName()
 * @method bool isLastName()
 * @method bool isVcard()
 * @method bool isReplyMarkup()
 * @method bool isInputMessageContent()
 * @method bool isThumbUrl()
 * @method bool isThumbWidth()
 * @method bool isThumbHeight()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setPhoneNumber(string $value)
 * @method $this setFirstName(string $value)
 * @method $this setLastName(string $value)
 * @method $this setVcard(string $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 * @method $this setThumbUrl(string $value)
 * @method $this setThumbWidth(int $value)
 * @method $this setThumbHeight(int $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetPhoneNumber()
 * @method $this unsetFirstName()
 * @method $this unsetLastName()
 * @method $this unsetVcard()
 * @method $this unsetReplyMarkup()
 * @method $this unsetInputMessageContent()
 * @method $this unsetThumbUrl()
 * @method $this unsetThumbWidth()
 * @method $this unsetThumbHeight()
 *
 * @property string $type
 * @property string $id
 * @property string $phone_number
 * @property string $first_name
 * @property string $last_name
 * @property string $vcard
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 * @property string $thumb_url
 * @property Int $thumb_width
 * @property Int $thumb_height
 */
class InlineQueryResultContact extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'phone_number' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'vcard' => 'string',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
        'thumb_url' => 'string',
        'thumb_width' => 'int',
        'thumb_height' => 'int',
    ];
}