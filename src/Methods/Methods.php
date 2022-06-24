<?php

namespace Jove\Methods;

use Jove\Methods\BotCommands\BotCommands;
use Jove\Methods\Chats\Chats;
use Jove\Methods\Messages\Messages;

trait Methods
{
    use BotCommands, Chats, Messages, GetUpdates;
}