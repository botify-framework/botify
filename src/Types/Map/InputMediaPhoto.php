<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputMediaPhoto
 *
 * @method string getType()
 * @method string getMedia()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 *
 * @method bool isType()
 * @method bool isMedia()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 *
 * @method $this setType(string $value)
 * @method $this setMedia(string $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 *
 * @method $this unsetType()
 * @method $this unsetMedia()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 *
 * @property string $type
 * @property string $media
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 */
class InputMediaPhoto extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'media' => 'string',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
    ];
}