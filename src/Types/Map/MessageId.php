<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * MessageId
 *
 * @method Int getMessageId()
 *
 * @method bool isMessageId()
 *
 * @method $this setMessageId(int $value)
 *
 * @method $this unsetMessageId()
 *
 * @property Int $message_id
 */
class MessageId extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'message_id' => 'int',
    ];
}