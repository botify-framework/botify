<?php

namespace Jove\Methods;

use Jove\Methods\BotCommands\BotCommands;
use Jove\Methods\Chats\Chats;
use Jove\Methods\Commons\Commons;
use Jove\Methods\Games\Games;
use Jove\Methods\Messages\Messages;
use Jove\Methods\Users\Users;
use Jove\Methods\Webhooks\Webhooks;

trait Methods
{
    use BotCommands, Chats, Commons, Games, Messages, Users, Webhooks;
}