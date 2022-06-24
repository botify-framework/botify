<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

class MenuButton extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        MenuButtonCommands::class,
        MenuButtonDefault::class,
        MenuButtonWebApp::class,
    ];
}