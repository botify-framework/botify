<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

class BotCommandScope extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        BotCommandScopeDefault::class,
        BotCommandScopeAllPrivateChats::class,
        BotCommandScopeAllGroupChats::class,
        BotCommandScopeAllChatAdministrators::class,
        BotCommandScopeChat::class,
        BotCommandScopeChatAdministrators::class,
        BotCommandScopeChatMember::class,
    ];
}