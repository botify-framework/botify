<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * PassportFile
 *
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method Int getFileSize()
 * @method Int getFileDate()
 *
 * @method bool isFileId()
 * @method bool isFileUniqueId()
 * @method bool isFileSize()
 * @method bool isFileDate()
 *
 * @method $this setFileId(string $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setFileSize(int $value)
 * @method $this setFileDate(int $value)
 *
 * @method $this unsetFileId()
 * @method $this unsetFileUniqueId()
 * @method $this unsetFileSize()
 * @method $this unsetFileDate()
 *
 * @property string $file_id
 * @property string $file_unique_id
 * @property Int $file_size
 * @property Int $file_date
 */
class PassportFile extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'file_id' => 'string',
        'file_unique_id' => 'string',
        'file_size' => 'int',
        'file_date' => 'int',
    ];
}