<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputMediaAnimation
 *
 * @method string getType()
 * @method string getMedia()
 * @method InputFileOrstring getThumb()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method Int getWidth()
 * @method Int getHeight()
 * @method Int getDuration()
 *
 * @method bool isType()
 * @method bool isMedia()
 * @method bool isThumb()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isWidth()
 * @method bool isHeight()
 * @method bool isDuration()
 *
 * @method $this setType(string $value)
 * @method $this setMedia(string $value)
 * @method $this setThumb(InputFileOrstring $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setWidth(int $value)
 * @method $this setHeight(int $value)
 * @method $this setDuration(int $value)
 *
 * @method $this unsetType()
 * @method $this unsetMedia()
 * @method $this unsetThumb()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetWidth()
 * @method $this unsetHeight()
 * @method $this unsetDuration()
 *
 * @property string $type
 * @property string $media
 * @property InputFileOrstring $thumb
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property Int $width
 * @property Int $height
 * @property Int $duration
 */
class InputMediaAnimation extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'media' => 'string',
        'thumb' => 'InputFileOrstring',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'width' => 'int',
        'height' => 'int',
        'duration' => 'int',
    ];
}