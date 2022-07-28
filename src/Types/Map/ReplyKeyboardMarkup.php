<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ReplyKeyboardMarkup
 *
 * @method KeyboardButton[] getKeyboard()
 * @method bool getResizeKeyboard()
 * @method bool getOneTimeKeyboard()
 * @method string getInputFieldPlaceholder()
 * @method bool getSelective()
 *
 * @method bool isKeyboard()
 * @method bool isResizeKeyboard()
 * @method bool isOneTimeKeyboard()
 * @method bool isInputFieldPlaceholder()
 * @method bool isSelective()
 *
 * @method $this setKeyboard(KeyboardButton[] $value)
 * @method $this setResizeKeyboard(bool $value)
 * @method $this setOneTimeKeyboard(bool $value)
 * @method $this setInputFieldPlaceholder(string $value)
 * @method $this setSelective(bool $value)
 *
 * @method $this unsetKeyboard()
 * @method $this unsetResizeKeyboard()
 * @method $this unsetOneTimeKeyboard()
 * @method $this unsetInputFieldPlaceholder()
 * @method $this unsetSelective()
 *
 * @property KeyboardButton[] $keyboard
 * @property bool $resize_keyboard
 * @property bool $one_time_keyboard
 * @property string $input_field_placeholder
 * @property bool $selective
 */
class ReplyKeyboardMarkup extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'keyboard' => 'KeyboardButton[]',
        'resize_keyboard' => 'bool',
        'one_time_keyboard' => 'bool',
        'input_field_placeholder' => 'string',
        'selective' => 'bool',
    ];
}