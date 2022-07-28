<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * BotCommandScopeChat
 *
 * @method string getType()
 * @method IntOrstring getChatId()
 *
 * @method bool isType()
 * @method bool isChatId()
 *
 * @method $this setType(string $value)
 * @method $this setChatId(intOrstring $value)
 *
 * @method $this unsetType()
 * @method $this unsetChatId()
 *
 * @property string $type
 * @property IntOrstring $chat_id
 */
class BotCommandScopeChat extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'chat_id' => 'IntOrstring',
    ];
}