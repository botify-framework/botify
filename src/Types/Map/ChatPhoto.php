<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatPhoto
 *
 * @method string getSmallFileId()
 * @method string getSmallFileUniqueId()
 * @method string getBigFileId()
 * @method string getBigFileUniqueId()
 *
 * @method bool isSmallFileId()
 * @method bool isSmallFileUniqueId()
 * @method bool isBigFileId()
 * @method bool isBigFileUniqueId()
 *
 * @method $this setSmallFileId(string $value)
 * @method $this setSmallFileUniqueId(string $value)
 * @method $this setBigFileId(string $value)
 * @method $this setBigFileUniqueId(string $value)
 *
 * @method $this unsetSmallFileId()
 * @method $this unsetSmallFileUniqueId()
 * @method $this unsetBigFileId()
 * @method $this unsetBigFileUniqueId()
 *
 * @property string $small_file_id
 * @property string $small_file_unique_id
 * @property string $big_file_id
 * @property string $big_file_unique_id
 */
class ChatPhoto extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'small_file_id' => 'string',
        'small_file_unique_id' => 'string',
        'big_file_id' => 'string',
        'big_file_unique_id' => 'string',
    ];
}