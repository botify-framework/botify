<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputMediaAudio
 *
 * @method string getType()
 * @method string getMedia()
 * @method InputFileOrstring getThumb()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method Int getDuration()
 * @method string getPerformer()
 * @method string getTitle()
 *
 * @method bool isType()
 * @method bool isMedia()
 * @method bool isThumb()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isDuration()
 * @method bool isPerformer()
 * @method bool isTitle()
 *
 * @method $this setType(string $value)
 * @method $this setMedia(string $value)
 * @method $this setThumb(InputFileOrstring $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setDuration(int $value)
 * @method $this setPerformer(string $value)
 * @method $this setTitle(string $value)
 *
 * @method $this unsetType()
 * @method $this unsetMedia()
 * @method $this unsetThumb()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetDuration()
 * @method $this unsetPerformer()
 * @method $this unsetTitle()
 *
 * @property string $type
 * @property string $media
 * @property InputFileOrstring $thumb
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property Int $duration
 * @property string $performer
 * @property string $title
 */
class InputMediaAudio extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'media' => 'string',
        'thumb' => 'InputFileOrstring',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'duration' => 'int',
        'performer' => 'string',
        'title' => 'string',
    ];
}