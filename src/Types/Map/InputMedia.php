<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

class InputMedia extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        InputMediaAnimation::class,
        InputMediaDocument::class,
        InputMediaAudio::class,
        InputMediaPhoto::class,
        InputMediaVideo::class,
    ];
}