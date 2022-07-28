<?php

namespace Botify\Types\Map;

use Botify\Traits\Downloadable;
use Botify\Utils\LazyJsonMapper;

/**
 * Audio
 *
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method Int getDuration()
 * @method string getPerformer()
 * @method string getTitle()
 * @method string getFileName()
 * @method string getMimeType()
 * @method Int getFileSize()
 * @method PhotoSize getThumb()
 *
 * @method bool isFileId()
 * @method bool isFileUniqueId()
 * @method bool isDuration()
 * @method bool isPerformer()
 * @method bool isTitle()
 * @method bool isFileName()
 * @method bool isMimeType()
 * @method bool isFileSize()
 * @method bool isThumb()
 *
 * @method $this setFileId(string $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setDuration(int $value)
 * @method $this setPerformer(string $value)
 * @method $this setTitle(string $value)
 * @method $this setFileName(string $value)
 * @method $this setMimeType(string $value)
 * @method $this setFileSize(int $value)
 * @method $this setThumb(PhotoSize $value)
 *
 * @method $this unsetFileId()
 * @method $this unsetFileUniqueId()
 * @method $this unsetDuration()
 * @method $this unsetPerformer()
 * @method $this unsetTitle()
 * @method $this unsetFileName()
 * @method $this unsetMimeType()
 * @method $this unsetFileSize()
 * @method $this unsetThumb()
 *
 * @property string $file_id
 * @property string $file_unique_id
 * @property Int $duration
 * @property string $performer
 * @property string $title
 * @property string $file_name
 * @property string $mime_type
 * @property Int $file_size
 * @property PhotoSize $thumb
 */
class Audio extends LazyJsonMapper
{

    use Downloadable;

    const JSON_PROPERTY_MAP = [
        'file_id' => 'string',
        'file_unique_id' => 'string',
        'duration' => 'int',
        'performer' => 'string',
        'title' => 'string',
        'file_name' => 'string',
        'mime_type' => 'string',
        'file_size' => 'int',
        'thumb' => 'PhotoSize',
    ];

    public function getDownloadableId(): string
    {
        return $this->getFileId();
    }
}