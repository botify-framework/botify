<?php

namespace Botify\Types\Map;

use Botify\Traits\Downloadable;
use Botify\Utils\LazyJsonMapper;

/**
 * Sticker
 *
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method Int getWidth()
 * @method Int getHeight()
 * @method bool getIsAnimated()
 * @method bool getIsVideo()
 * @method PhotoSize getThumb()
 * @method string getEmoji()
 * @method string getSetName()
 * @method MaskPosition getMaskPosition()
 * @method Int getFileSize()
 *
 * @method bool isFileId()
 * @method bool isFileUniqueId()
 * @method bool isWidth()
 * @method bool isHeight()
 * @method bool isIsAnimated()
 * @method bool isIsVideo()
 * @method bool isThumb()
 * @method bool isEmoji()
 * @method bool isSetName()
 * @method bool isMaskPosition()
 * @method bool isFileSize()
 *
 * @method $this setFileId(string $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setWidth(int $value)
 * @method $this setHeight(int $value)
 * @method $this setIsAnimated(bool $value)
 * @method $this setIsVideo(bool $value)
 * @method $this setThumb(PhotoSize $value)
 * @method $this setEmoji(string $value)
 * @method $this setSetName(string $value)
 * @method $this setMaskPosition(MaskPosition $value)
 * @method $this setFileSize(int $value)
 *
 * @method $this unsetFileId()
 * @method $this unsetFileUniqueId()
 * @method $this unsetWidth()
 * @method $this unsetHeight()
 * @method $this unsetIsAnimated()
 * @method $this unsetIsVideo()
 * @method $this unsetThumb()
 * @method $this unsetEmoji()
 * @method $this unsetSetName()
 * @method $this unsetMaskPosition()
 * @method $this unsetFileSize()
 *
 * @property string $file_id
 * @property string $file_unique_id
 * @property Int $width
 * @property Int $height
 * @property bool $is_animated
 * @property bool $is_video
 * @property PhotoSize $thumb
 * @property string $emoji
 * @property string $set_name
 * @property MaskPosition $mask_position
 * @property Int $file_size
 */
class Sticker extends LazyJsonMapper
{

    use Downloadable;

    const JSON_PROPERTY_MAP = [
        'file_id' => 'string',
        'file_unique_id' => 'string',
        'width' => 'int',
        'height' => 'int',
        'is_animated' => 'bool',
        'is_video' => 'bool',
        'thumb' => 'PhotoSize',
        'emoji' => 'string',
        'set_name' => 'string',
        'mask_position' => 'MaskPosition',
        'file_size' => 'int',
    ];

    public function getDownloadableId(): string
    {
        return $this->getFileId();
    }
}