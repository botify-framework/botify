<?php

namespace Botify\Utils;

class FallbackResponse extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'ok' => 'bool',
        'description' => 'string',
        'error_code' => 'int',
        'parameters' => 'ResponseParameters',
    ];

    public function _init()
    {
        parent::_init();
    }
}