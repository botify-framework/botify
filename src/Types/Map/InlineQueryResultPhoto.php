<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultPhoto
 *
 * @method string getType()
 * @method string getId()
 * @method string getPhotoUrl()
 * @method string getThumbUrl()
 * @method Int getPhotoWidth()
 * @method Int getPhotoHeight()
 * @method string getTitle()
 * @method string getDescription()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method InputMessageContent getInputMessageContent()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isPhotoUrl()
 * @method bool isThumbUrl()
 * @method bool isPhotoWidth()
 * @method bool isPhotoHeight()
 * @method bool isTitle()
 * @method bool isDescription()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isReplyMarkup()
 * @method bool isInputMessageContent()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setPhotoUrl(string $value)
 * @method $this setThumbUrl(string $value)
 * @method $this setPhotoWidth(int $value)
 * @method $this setPhotoHeight(int $value)
 * @method $this setTitle(string $value)
 * @method $this setDescription(string $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetPhotoUrl()
 * @method $this unsetThumbUrl()
 * @method $this unsetPhotoWidth()
 * @method $this unsetPhotoHeight()
 * @method $this unsetTitle()
 * @method $this unsetDescription()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetReplyMarkup()
 * @method $this unsetInputMessageContent()
 *
 * @property string $type
 * @property string $id
 * @property string $photo_url
 * @property string $thumb_url
 * @property Int $photo_width
 * @property Int $photo_height
 * @property string $title
 * @property string $description
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 */
class InlineQueryResultPhoto extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'photo_url' => 'string',
        'thumb_url' => 'string',
        'photo_width' => 'int',
        'photo_height' => 'int',
        'title' => 'string',
        'description' => 'string',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}