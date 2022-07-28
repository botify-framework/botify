<?php

namespace Botify\Types\Map;

use Botify\Traits\Downloadable;
use Botify\Utils\LazyJsonMapper;

/**
 * Voice
 *
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method Int getDuration()
 * @method string getMimeType()
 * @method Int getFileSize()
 *
 * @method bool isFileId()
 * @method bool isFileUniqueId()
 * @method bool isDuration()
 * @method bool isMimeType()
 * @method bool isFileSize()
 *
 * @method $this setFileId(string $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setDuration(int $value)
 * @method $this setMimeType(string $value)
 * @method $this setFileSize(int $value)
 *
 * @method $this unsetFileId()
 * @method $this unsetFileUniqueId()
 * @method $this unsetDuration()
 * @method $this unsetMimeType()
 * @method $this unsetFileSize()
 *
 * @property string $file_id
 * @property string $file_unique_id
 * @property Int $duration
 * @property string $mime_type
 * @property Int $file_size
 */
class Voice extends LazyJsonMapper
{

    use Downloadable;

    const JSON_PROPERTY_MAP = [
        'file_id' => 'string',
        'file_unique_id' => 'string',
        'duration' => 'int',
        'mime_type' => 'string',
        'file_size' => 'int',
    ];

    public function getDownloadableId(): string
    {
        return $this->getFileId();
    }
}