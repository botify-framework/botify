<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * ReplyKeyboardMarkup
 *
 * @method KeyboardButton[] getKeyboard()
 * @method Bool getResizeKeyboard()
 * @method Bool getOneTimeKeyboard()
 * @method string getInputFieldPlaceholder()
 * @method Bool getSelective()
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
 * @property Bool $resize_keyboard
 * @property Bool $one_time_keyboard
 * @property string $input_field_placeholder
 * @property Bool $selective
 */

class ReplyKeyboardMarkup extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'keyboard' => 'KeyboardButton[]',		'resize_keyboard' => 'Bool',		'one_time_keyboard' => 'Bool',		'input_field_placeholder' => 'string',		'selective' => 'Bool',	];
}