<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * VideoChatEnded
 *
 * @method Int getDuration()
 *
 * @method bool isDuration()
 *
 * @method $this setDuration(int $value)
 *
 * @method $this unsetDuration()
 *
 * @property Int $duration
 */
class VideoChatEnded extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'duration' => 'int',
    ];
}