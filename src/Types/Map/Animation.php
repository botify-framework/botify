<?php
namespace Jove\Types\Map;

use LazyJsonMapper\LazyJsonMapper;

/**
 * Animation.
 *
 * @method int getDuration()
 * @method string getFileId()
 * @method string getFileName()
 * @method int getFileSize()
 * @method string getFileUniqueId()
 * @method int getHeight()
 * @method string getMimeType()
 * @method PhotoSize getThumb()
 * @method int getWidth()
 * @method bool isDuration()
 * @method bool isFileId()
 * @method bool isFileName()
 * @method bool isFileSize()
 * @method bool isFileUniqueId()
 * @method bool isHeight()
 * @method bool isMimeType()
 * @method bool isThumb()
 * @method bool isWidth()
 * @method $this setDuration(int $value)
 * @method $this setFileId(string $value)
 * @method $this setFileName(string $value)
 * @method $this setFileSize(int $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setHeight(int $value)
 * @method $this setMimeType(string $value)
 * @method $this setThumb(PhotoSize $value)
 * @method $this setWidth(int $value)
 * @method $this unsetDuration()
 * @method $this unsetFileId()
 * @method $this unsetFileName()
 * @method $this unsetFileSize()
 * @method $this unsetFileUniqueId()
 * @method $this unsetHeight()
 * @method $this unsetMimeType()
 * @method $this unsetThumb()
 * @method $this unsetWidth()
 *
 * @property int $duration
 * @property string $file_id
 * @property string $file_name
 * @property int $file_size
 * @property string $file_unique_id
 * @property int $height
 * @property string $mime_type
 * @property PhotoSize $thumb
 * @property int $width
 */
class Animation extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'file_unique_id' => 'string',
        'file_id'        => 'string',
        'width'          => 'int',
        'height'         => 'int',
        'duration'       => 'int',
        'thumb'          => 'PhotoSize',
        'file_name'      => 'string',
        'mime_type'      => 'string',
        'file_size'      => 'int',
    ];
}