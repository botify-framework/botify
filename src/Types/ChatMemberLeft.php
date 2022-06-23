<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * ChatMemberLeft
 *
 * @method string getStatus()
 * @method User getUser()
 *
 * @method bool isStatus()
 * @method bool isUser()
 *
 * @method $this setStatus(string $value)
 * @method $this setUser(User $value)
 *
 * @method $this unsetStatus()
 * @method $this unsetUser()
 *
 * @property string $status
 * @property User $user
 */

class ChatMemberLeft extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'status' => 'string',		'user' => 'User',	];
}