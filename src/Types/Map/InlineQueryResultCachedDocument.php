<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultCachedDocument
 *
 * @method string getType()
 * @method string getId()
 * @method string getTitle()
 * @method string getDocumentFileId()
 * @method string getDescription()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method InputMessageContent getInputMessageContent()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isTitle()
 * @method bool isDocumentFileId()
 * @method bool isDescription()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isReplyMarkup()
 * @method bool isInputMessageContent()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setTitle(string $value)
 * @method $this setDocumentFileId(string $value)
 * @method $this setDescription(string $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetTitle()
 * @method $this unsetDocumentFileId()
 * @method $this unsetDescription()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetReplyMarkup()
 * @method $this unsetInputMessageContent()
 *
 * @property string $type
 * @property string $id
 * @property string $title
 * @property string $document_file_id
 * @property string $description
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 */
class InlineQueryResultCachedDocument extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'title' => 'string',
        'document_file_id' => 'string',
        'description' => 'string',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}