<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * BotCommandScopeChatMember
 *
 * @method string getType()
 * @method IntOrstring getChatId()
 * @method Int getUserId()
 *
 * @method bool isType()
 * @method bool isChatId()
 * @method bool isUserId()
 *
 * @method $this setType(string $value)
 * @method $this setChatId(intOrstring $value)
 * @method $this setUserId(int $value)
 *
 * @method $this unsetType()
 * @method $this unsetChatId()
 * @method $this unsetUserId()
 *
 * @property string $type
 * @property IntOrstring $chat_id
 * @property Int $user_id
 */
class BotCommandScopeChatMember extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'chat_id' => 'IntOrstring',
        'user_id' => 'int',
    ];
}