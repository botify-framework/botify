<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * ForceReply
 *
 * @method Bool getForceReply()
 * @method string getInputFieldPlaceholder()
 * @method Bool getSelective()
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
 * @property Bool $force_reply
 * @property string $input_field_placeholder
 * @property Bool $selective
 */
class ForceReply extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'force_reply' => 'Bool',
        'input_field_placeholder' => 'string',
        'selective' => 'Bool',
    ];
}