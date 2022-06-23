<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * LabeledPrice
 *
 * @method string getLabel()
 * @method Int getAmount()
 *
 * @method bool isLabel()
 * @method bool isAmount()
 *
 * @method $this setLabel(string $value)
 * @method $this setAmount(int $value)
 *
 * @method $this unsetLabel()
 * @method $this unsetAmount()
 *
 * @property string $label
 * @property Int $amount
 */

class LabeledPrice extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'label' => 'string',		'amount' => 'int',	];
}