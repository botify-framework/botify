<?php

namespace Botify\Types\Map;

use Botify\Traits\Downloadable;
use Botify\Utils\LazyJsonMapper;

/**
 * VideoNote
 *
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method Int getLength()
 * @method Int getDuration()
 * @method PhotoSize getThumb()
 * @method Int getFileSize()
 *
 * @method bool isFileId()
 * @method bool isFileUniqueId()
 * @method bool isLength()
 * @method bool isDuration()
 * @method bool isThumb()
 * @method bool isFileSize()
 *
 * @method $this setFileId(string $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setLength(int $value)
 * @method $this setDuration(int $value)
 * @method $this setThumb(PhotoSize $value)
 * @method $this setFileSize(int $value)
 *
 * @method $this unsetFileId()
 * @method $this unsetFileUniqueId()
 * @method $this unsetLength()
 * @method $this unsetDuration()
 * @method $this unsetThumb()
 * @method $this unsetFileSize()
 *
 * @property string $file_id
 * @property string $file_unique_id
 * @property Int $length
 * @property Int $duration
 * @property PhotoSize $thumb
 * @property Int $file_size
 */
class VideoNote extends LazyJsonMapper
{

    use Downloadable;

    const JSON_PROPERTY_MAP = [
        'file_id' => 'string',
        'file_unique_id' => 'string',
        'length' => 'int',
        'duration' => 'int',
        'thumb' => 'PhotoSize',
        'file_size' => 'int',
    ];

    public function getDownloadableId(): string
    {
        return $this->getFileId();
    }
}