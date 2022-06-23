<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * VideoChatScheduled
 *
 * @method Int getStartDate()
 *
 * @method bool isStartDate()
 *
 * @method $this setStartDate(int $value)
 *
 * @method $this unsetStartDate()
 *
 * @property Int $start_date
 */

class VideoChatScheduled extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'start_date' => 'int',	];
}