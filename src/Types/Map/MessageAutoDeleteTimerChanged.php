<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * MessageAutoDeleteTimerChanged
 *
 * @method Int getMessageAutoDeleteTime()
 *
 * @method bool isMessageAutoDeleteTime()
 *
 * @method $this setMessageAutoDeleteTime(int $value)
 *
 * @method $this unsetMessageAutoDeleteTime()
 *
 * @property Int $message_auto_delete_time
 */
class MessageAutoDeleteTimerChanged extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'message_auto_delete_time' => 'int',
    ];
}