<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

class ChatMember extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        ChatMemberOwner::class,
        ChatMemberAdministrator::class,
        ChatMemberMember::class,
        ChatMemberRestricted::class,
        ChatMemberLeft::class,
        ChatMemberBanned::class,
    ];
}