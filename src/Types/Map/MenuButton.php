<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

class MenuButton extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        MenuButtonCommands::class,
        MenuButtonDefault::class,
        MenuButtonWebApp::class,
    ];
}