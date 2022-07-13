<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * InlineKeyboardMarkup
 *
 * @method InlineKeyboardButton[] getInlineKeyboard()
 *
 * @method bool isInlineKeyboard()
 *
 * @method $this setInlineKeyboard(InlineKeyboardButton[] $value)
 *
 * @method $this unsetInlineKeyboard()
 *
 * @property InlineKeyboardButton[] $inline_keyboard
 */
class InlineKeyboardMarkup extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'inline_keyboard' => 'InlineKeyboardButton[][]',
    ];
}