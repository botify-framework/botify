<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultCachedVideo
 *
 * @method string getType()
 * @method string getId()
 * @method string getVideoFileId()
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
 * @method bool isVideoFileId()
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
 * @method $this setVideoFileId(string $value)
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
 * @method $this unsetVideoFileId()
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
 * @property string $video_file_id
 * @property string $title
 * @property string $description
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 */
class InlineQueryResultCachedVideo extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'video_file_id' => 'string',
        'title' => 'string',
        'description' => 'string',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}