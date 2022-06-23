<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * ReplyKeyboardRemove
 *
 * @method Bool getRemoveKeyboard()
 * @method Bool getSelective()
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
 * @property Bool $remove_keyboard
 * @property Bool $selective
 */

class ReplyKeyboardRemove extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'remove_keyboard' => 'Bool',		'selective' => 'Bool',	];
}