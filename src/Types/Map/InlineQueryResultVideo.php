<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultVideo
 *
 * @method string getType()
 * @method string getId()
 * @method string getVideoUrl()
 * @method string getMimeType()
 * @method string getThumbUrl()
 * @method string getTitle()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method Int getVideoWidth()
 * @method Int getVideoHeight()
 * @method Int getVideoDuration()
 * @method string getDescription()
 * @method InlineKeyboardMarkup getReplyMarkup()
 * @method InputMessageContent getInputMessageContent()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isVideoUrl()
 * @method bool isMimeType()
 * @method bool isThumbUrl()
 * @method bool isTitle()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isVideoWidth()
 * @method bool isVideoHeight()
 * @method bool isVideoDuration()
 * @method bool isDescription()
 * @method bool isReplyMarkup()
 * @method bool isInputMessageContent()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setVideoUrl(string $value)
 * @method $this setMimeType(string $value)
 * @method $this setThumbUrl(string $value)
 * @method $this setTitle(string $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setVideoWidth(int $value)
 * @method $this setVideoHeight(int $value)
 * @method $this setVideoDuration(int $value)
 * @method $this setDescription(string $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 * @method $this setInputMessageContent(InputMessageContent $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetVideoUrl()
 * @method $this unsetMimeType()
 * @method $this unsetThumbUrl()
 * @method $this unsetTitle()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetVideoWidth()
 * @method $this unsetVideoHeight()
 * @method $this unsetVideoDuration()
 * @method $this unsetDescription()
 * @method $this unsetReplyMarkup()
 * @method $this unsetInputMessageContent()
 *
 * @property string $type
 * @property string $id
 * @property string $video_url
 * @property string $mime_type
 * @property string $thumb_url
 * @property string $title
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property Int $video_width
 * @property Int $video_height
 * @property Int $video_duration
 * @property string $description
 * @property InlineKeyboardMarkup $reply_markup
 * @property InputMessageContent $input_message_content
 */
class InlineQueryResultVideo extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'video_url' => 'string',
        'mime_type' => 'string',
        'thumb_url' => 'string',
        'title' => 'string',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'video_width' => 'int',
        'video_height' => 'int',
        'video_duration' => 'int',
        'description' => 'string',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}