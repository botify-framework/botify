<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultGif
 *
 * @method string getType()
 * @method string getId()
 * @method string getGifUrl()
 * @method Int getGifWidth()
 * @method Int getGifHeight()
 * @method Int getGifDuration()
 * @method string getThumbUrl()
 * @method string getThumbMimeType()
 * @method string getTitle()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method InputMessageContent getInputMessageContent()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isGifUrl()
 * @method bool isGifWidth()
 * @method bool isGifHeight()
 * @method bool isGifDuration()
 * @method bool isThumbUrl()
 * @method bool isThumbMimeType()
 * @method bool isTitle()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isReplyMarkup()
 * @method bool isInputMessageContent()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setGifUrl(string $value)
 * @method $this setGifWidth(int $value)
 * @method $this setGifHeight(int $value)
 * @method $this setGifDuration(int $value)
 * @method $this setThumbUrl(string $value)
 * @method $this setThumbMimeType(string $value)
 * @method $this setTitle(string $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetGifUrl()
 * @method $this unsetGifWidth()
 * @method $this unsetGifHeight()
 * @method $this unsetGifDuration()
 * @method $this unsetThumbUrl()
 * @method $this unsetThumbMimeType()
 * @method $this unsetTitle()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetReplyMarkup()
 * @method $this unsetInputMessageContent()
 *
 * @property string $type
 * @property string $id
 * @property string $gif_url
 * @property Int $gif_width
 * @property Int $gif_height
 * @property Int $gif_duration
 * @property string $thumb_url
 * @property string $thumb_mime_type
 * @property string $title
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 */
class InlineQueryResultGif extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'gif_url' => 'string',
        'gif_width' => 'int',
        'gif_height' => 'int',
        'gif_duration' => 'int',
        'thumb_url' => 'string',
        'thumb_mime_type' => 'string',
        'title' => 'string',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}