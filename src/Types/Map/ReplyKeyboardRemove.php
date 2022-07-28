<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ReplyKeyboardRemove
 *
 * @method bool getRemoveKeyboard()
 * @method bool getSelective()
 *
 * @method bool isRemoveKeyboard()
 * @method bool isSelective()
 *
 * @method $this setRemoveKeyboard(bool $value)
 * @method $this setSelective(bool $value)
 *
 * @method $this unsetRemoveKeyboard()
 * @method $this unsetSelective()
 *
 * @property bool $remove_keyboard
 * @property bool $selective
 */
class ReplyKeyboardRemove extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'remove_keyboard' => 'bool',
        'selective' => 'bool',
    ];
}