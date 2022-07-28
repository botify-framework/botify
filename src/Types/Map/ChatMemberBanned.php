<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatMemberBanned
 *
 * @method string getStatus()
 * @method User getUser()
 * @method Int getUntilDate()
 *
 * @method bool isStatus()
 * @method bool isUser()
 * @method bool isUntilDate()
 *
 * @method $this setStatus(string $value)
 * @method $this setUser(User $value)
 * @method $this setUntilDate(int $value)
 *
 * @method $this unsetStatus()
 * @method $this unsetUser()
 * @method $this unsetUntilDate()
 *
 * @property string $status
 * @property User $user
 * @property Int $until_date
 */
class ChatMemberBanned extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user' => 'User',
        'until_date' => 'int',
    ];
}