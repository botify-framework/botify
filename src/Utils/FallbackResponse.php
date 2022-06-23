<?php

namespace Jove\Utils;

class FallbackResponse extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'ok' => 'bool',
        'description' => 'string',
        'error_code' => 'int',
        'retry_after' => 'int',
    ];
}