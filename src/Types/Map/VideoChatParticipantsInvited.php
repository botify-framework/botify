<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * VideoChatParticipantsInvited
 *
 * @method User[] getUsers()
 *
 * @method bool isUsers()
 *
 * @method $this setUsers(User[] $value)
 *
 * @method $this unsetUsers()
 *
 * @property User[] $users
 */
class VideoChatParticipantsInvited extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'users' => 'User[]',
    ];
}