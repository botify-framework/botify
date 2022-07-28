<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultMpeg4Gif
 *
 * @method string getType()
 * @method string getId()
 * @method string getMpeg4Url()
 * @method Int getMpeg4Width()
 * @method Int getMpeg4Height()
 * @method Int getMpeg4Duration()
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
 * @method bool isMpeg4Url()
 * @method bool isMpeg4Width()
 * @method bool isMpeg4Height()
 * @method bool isMpeg4Duration()
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
 * @method $this setMpeg4Url(string $value)
 * @method $this setMpeg4Width(int $value)
 * @method $this setMpeg4Height(int $value)
 * @method $this setMpeg4Duration(int $value)
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
 * @method $this unsetMpeg4Url()
 * @method $this unsetMpeg4Width()
 * @method $this unsetMpeg4Height()
 * @method $this unsetMpeg4Duration()
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
 * @property string $mpeg4_url
 * @property Int $mpeg4_width
 * @property Int $mpeg4_height
 * @property Int $mpeg4_duration
 * @property string $thumb_url
 * @property string $thumb_mime_type
 * @property string $title
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 */
class InlineQueryResultMpeg4Gif extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'mpeg4_url' => 'string',
        'mpeg4_width' => 'int',
        'mpeg4_height' => 'int',
        'mpeg4_duration' => 'int',
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