<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * PassportElementErrorFiles
 *
 * @method string getSource()
 * @method string getType()
 * @method string[] getFileHashes()
 * @method string getMessage()
 *
 * @method bool isSource()
 * @method bool isType()
 * @method bool isFileHashes()
 * @method bool isMessage()
 *
 * @method $this setSource(string $value)
 * @method $this setType(string $value)
 * @method $this setFileHashes(string[] $value)
 * @method $this setMessage(string $value)
 *
 * @method $this unsetSource()
 * @method $this unsetType()
 * @method $this unsetFileHashes()
 * @method $this unsetMessage()
 *
 * @property string $source
 * @property string $type
 * @property string[] $file_hashes
 * @property string $message
 */
class PassportElementErrorFiles extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'source' => 'string',
        'type' => 'string',
        'file_hashes' => 'string[]',
        'message' => 'string',
    ];
}