<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * File
 *
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method Int getFileSize()
 * @method string getFilePath()
 *
 * @method bool isFileId()
 * @method bool isFileUniqueId()
 * @method bool isFileSize()
 * @method bool isFilePath()
 *
 * @method $this setFileId(string $value)
 * @method $this setFileUniqueId(string $value)
 * @method $this setFileSize(int $value)
 * @method $this setFilePath(string $value)
 *
 * @method $this unsetFileId()
 * @method $this unsetFileUniqueId()
 * @method $this unsetFileSize()
 * @method $this unsetFilePath()
 *
 * @property string $file_id
 * @property string $file_unique_id
 * @property Int $file_size
 * @property string $file_path
 */
class File extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'file_id' => 'string',
        'file_unique_id' => 'string',
        'file_size' => 'int',
        'file_path' => 'string',
    ];
}