<?php

namespace Botify\Types\Map;

use Botify\Traits\Downloadable;
use Botify\Utils\LazyJsonMapper;

/**
 * Video
 *
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method Int getWidth()
 * @method Int getHeight()
 * @method Int getDuration()
 * @method PhotoSize getThumb()
 * @method string getFileName()
 * @method string getMimeType()
 * @method Int getFileSize()
 *
 * @method bool isFileId()
 * @method bool isFileUniqueId()
 * @method bool isWidth()
 * @method bool isHeight()
 * @method bool isDuration()
 * @method bool isThumb()
 * @method bool isFileName()
 * @method bool isMimeType()
 * @method bool isFileSize()
 *
 * @method $this setFileId(string $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setWidth(int $value)
 * @method $this setHeight(int $value)
 * @method $this setDuration(int $value)
 * @method $this setThumb(PhotoSize $value)
 * @method $this setFileName(string $value)
 * @method $this setMimeType(string $value)
 * @method $this setFileSize(int $value)
 *
 * @method $this unsetFileId()
 * @method $this unsetFileUniqueId()
 * @method $this unsetWidth()
 * @method $this unsetHeight()
 * @method $this unsetDuration()
 * @method $this unsetThumb()
 * @method $this unsetFileName()
 * @method $this unsetMimeType()
 * @method $this unsetFileSize()
 *
 * @property string $file_id
 * @property string $file_unique_id
 * @property Int $width
 * @property Int $height
 * @property Int $duration
 * @property PhotoSize $thumb
 * @property string $file_name
 * @property string $mime_type
 * @property Int $file_size
 */
class Video extends LazyJsonMapper
{

    use Downloadable;

    const JSON_PROPERTY_MAP = [
        'file_id' => 'string',
        'file_unique_id' => 'string',
        'width' => 'int',
        'height' => 'int',
        'duration' => 'int',
        'thumb' => 'PhotoSize',
        'file_name' => 'string',
        'mime_type' => 'string',
        'file_size' => 'int',
    ];

    public function getDownloadableId(): string
    {
        return $this->getFileId();
    }
}