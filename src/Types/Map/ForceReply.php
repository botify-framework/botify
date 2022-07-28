<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ForceReply
 *
 * @method bool getForceReply()
 * @method string getInputFieldPlaceholder()
 * @method bool getSelective()
 *
 * @method bool isForceReply()
 * @method bool isInputFieldPlaceholder()
 * @method bool isSelective()
 *
 * @method $this setForceReply(bool $value)
 * @method $this setInputFieldPlaceholder(string $value)
 * @method $this setSelective(bool $value)
 *
 * @method $this unsetForceReply()
 * @method $this unsetInputFieldPlaceholder()
 * @method $this unsetSelective()
 *
 * @property bool $force_reply
 * @property string $input_field_placeholder
 * @property bool $selective
 */
class ForceReply extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'force_reply' => 'bool',
        'input_field_placeholder' => 'string',
        'selective' => 'bool',
    ];
}