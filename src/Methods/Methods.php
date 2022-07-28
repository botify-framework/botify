<?php

namespace Botify\Methods;

use Botify\Methods\BotCommands\BotCommands;
use Botify\Methods\Chats\Chats;
use Botify\Methods\Commons\Commons;
use Botify\Methods\Games\Games;
use Botify\Methods\Messages\Messages;
use Botify\Methods\Users\Users;
use Botify\Methods\Webhooks\Webhooks;

trait Methods
{
    use BotCommands, Chats, Commons, Games, Messages, Users, Webhooks;
}