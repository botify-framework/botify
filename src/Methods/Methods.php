<?php

namespace Jove\Methods;

use Jove\Methods\BotCommands\BotCommands;
use Jove\Methods\Chats\Chats;
use Jove\Methods\Games\Games;
use Jove\Methods\Messages\Messages;

trait Methods
{
    use BotCommands, Chats, Games, Messages, GetUpdates;
}