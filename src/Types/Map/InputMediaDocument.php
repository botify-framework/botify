<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputMediaDocument
 *
 * @method string getType()
 * @method string getMedia()
 * @method InputFileOrstring getThumb()
 * @method string getCaption()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getCaptionEntities()
 * @method bool getDisableContentTypeDetection()
 *
 * @method bool isType()
 * @method bool isMedia()
 * @method bool isThumb()
 * @method bool isCaption()
 * @method bool isParseMode()
 * @method bool isCaptionEntities()
 * @method bool isDisableContentTypeDetection()
 *
 * @method $this setType(string $value)
 * @method $this setMedia(string $value)
 * @method $this setThumb(InputFileOrstring $value)
 * @method $this setCaption(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setDisableContentTypeDetection(bool $value)
 *
 * @method $this unsetType()
 * @method $this unsetMedia()
 * @method $this unsetThumb()
 * @method $this unsetCaption()
 * @method $this unsetParseMode()
 * @method $this unsetCaptionEntities()
 * @method $this unsetDisableContentTypeDetection()
 *
 * @property string $type
 * @property string $media
 * @property InputFileOrstring $thumb
 * @property string $caption
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $caption_entities
 * @property bool $disable_content_type_detection
 */
class InputMediaDocument extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'media' => 'string',
        'thumb' => 'InputFileOrstring',
        'caption' => 'string',
        'parse_mode' => 'ParseMode',
        'caption_entities' => 'MessageEntity[]',
        'disable_content_type_detection' => 'bool',
    ];
}