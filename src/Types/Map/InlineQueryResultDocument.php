<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultDocument
 *
 * @method string getType()
 * @method string getId()
 * @method string getTitle()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method string getDocumentUrl()
 * @method string getMimeType()
 * @method string getDescription()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method InputMessageContent getInputMessageContent()
 * @method string getThumbUrl()
 * @method Int getThumbWidth()
 * @method Int getThumbHeight()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isTitle()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isDocumentUrl()
 * @method bool isMimeType()
 * @method bool isDescription()
 * @method bool isReplyMarkup()
 * @method bool isInputMessageContent()
 * @method bool isThumbUrl()
 * @method bool isThumbWidth()
 * @method bool isThumbHeight()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setTitle(string $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setDocumentUrl(string $value)
 * @method $this setMimeType(string $value)
 * @method $this setDescription(string $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 * @method $this setThumbUrl(string $value)
 * @method $this setThumbWidth(int $value)
 * @method $this setThumbHeight(int $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetTitle()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetDocumentUrl()
 * @method $this unsetMimeType()
 * @method $this unsetDescription()
 * @method $this unsetReplyMarkup()
 * @method $this unsetInputMessageContent()
 * @method $this unsetThumbUrl()
 * @method $this unsetThumbWidth()
 * @method $this unsetThumbHeight()
 *
 * @property string $type
 * @property string $id
 * @property string $title
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property string $document_url
 * @property string $mime_type
 * @property string $description
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 * @property string $thumb_url
 * @property Int $thumb_width
 * @property Int $thumb_height
 */
class InlineQueryResultDocument extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'title' => 'string',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'document_url' => 'string',
        'mime_type' => 'string',
        'description' => 'string',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
        'thumb_url' => 'string',
        'thumb_width' => 'int',
        'thumb_height' => 'int',
    ];
}