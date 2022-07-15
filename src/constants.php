<?php

namespace Jove\Utils\Plugins\Filter;

use Jove\TelegramAPI;
use Jove\Types\Update;

function is_message(TelegramAPI $api, Update $update): bool
{
    return isset($update['message']) || isset($update['edited_message']);
}

const IS_MESSAGE = __NAMESPACE__ . '\\is_message';