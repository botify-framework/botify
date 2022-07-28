<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * PassportElementErrorDataField
 *
 * @method string getSource()
 * @method string getType()
 * @method string getFieldName()
 * @method string getDataHash()
 * @method string getMessage()
 *
 * @method bool isSource()
 * @method bool isType()
 * @method bool isFieldName()
 * @method bool isDataHash()
 * @method bool isMessage()
 *
 * @method $this setSource(string $value)
 * @method $this setType(string $value)
 * @method $this setFieldName(string $value)
 * @method $this setDataHash(string $value)
 * @method $this setMessage(string $value)
 *
 * @method $this unsetSource()
 * @method $this unsetType()
 * @method $this unsetFieldName()
 * @method $this unsetDataHash()
 * @method $this unsetMessage()
 *
 * @property string $source
 * @property string $type
 * @property string $field_name
 * @property string $data_hash
 * @property string $message
 */
class PassportElementErrorDataField extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'source' => 'string',
        'type' => 'string',
        'field_name' => 'string',
        'data_hash' => 'string',
        'message' => 'string',
    ];
}