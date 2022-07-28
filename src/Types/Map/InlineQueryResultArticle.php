<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultArticle
 *
 * @method string getType()
 * @method string getId()
 * @method string getTitle()
 * @method InputMessageContent getInputMessageContent()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method string getUrl()
 * @method bool getHideUrl()
 * @method string getDescription()
 * @method string getThumbUrl()
 * @method Int getThumbWidth()
 * @method Int getThumbHeight()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isTitle()
 * @method bool isInputMessageContent()
 * @method bool isReplyMarkup()
 * @method bool isUrl()
 * @method bool isHideUrl()
 * @method bool isDescription()
 * @method bool isThumbUrl()
 * @method bool isThumbWidth()
 * @method bool isThumbHeight()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setTitle(string $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setUrl(string $value)
 * @method $this setHideUrl(bool $value)
 * @method $this setDescription(string $value)
 * @method $this setThumbUrl(string $value)
 * @method $this setThumbWidth(int $value)
 * @method $this setThumbHeight(int $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetTitle()
 * @method $this unsetInputMessageContent()
 * @method $this unsetReplyMarkup()
 * @method $this unsetUrl()
 * @method $this unsetHideUrl()
 * @method $this unsetDescription()
 * @method $this unsetThumbUrl()
 * @method $this unsetThumbWidth()
 * @method $this unsetThumbHeight()
 *
 * @property string $type
 * @property string $id
 * @property string $title
 * @property InputMessageContent $input_message_content
 * @property InlineKeyboardMarkup $reply_markup
 * @property string $url
 * @property bool $hide_url
 * @property string $description
 * @property string $thumb_url
 * @property Int $thumb_width
 * @property Int $thumb_height
 */
class InlineQueryResultArticle extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'title' => 'string',
        'input_message_content' => 'InputMessageContent',
        'reply_markup' => 'InlineKeyboardMarkup',
        'url' => 'string',
        'hide_url' => 'bool',
        'description' => 'string',
        'thumb_url' => 'string',
        'thumb_width' => 'int',
        'thumb_height' => 'int',
    ];
}