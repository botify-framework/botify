<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatMemberMember
 *
 * @method string getStatus()
 * @method User getUser()
 *
 * @method bool isStatus()
 * @method bool isUser()
 *
 * @method $this setStatus(string $value)
 * @method $this setUser(User $value)
 *
 * @method $this unsetStatus()
 * @method $this unsetUser()
 *
 * @property string $status
 * @property User $user
 */
class ChatMemberMember extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user' => 'User',
    ];
}