<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * SentWebAppMessage
 *
 * @method string getInlineMessageId()
 *
 * @method bool isInlineMessageId()
 *
 * @method $this setInlineMessageId(string $value)
 *
 * @method $this unsetInlineMessageId()
 *
 * @property string $inline_message_id
 */
class SentWebAppMessage extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'inline_message_id' => 'string',
    ];
}