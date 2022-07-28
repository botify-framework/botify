<?php

namespace Botify\Utils;

class ResponseParameters extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'migrate_to_chat_id' => 'int',
        'retry_after' => 'int',
    ];
}