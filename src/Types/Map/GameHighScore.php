<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * GameHighScore
 *
 * @method Int getPosition()
 * @method User getUser()
 * @method Int getScore()
 *
 * @method bool isPosition()
 * @method bool isUser()
 * @method bool isScore()
 *
 * @method $this setPosition(int $value)
 * @method $this setUser(User $value)
 * @method $this setScore(int $value)
 *
 * @method $this unsetPosition()
 * @method $this unsetUser()
 * @method $this unsetScore()
 *
 * @property Int $position
 * @property User $user
 * @property Int $score
 */
class GameHighScore extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'position' => 'int',
        'user' => 'User',
        'score' => 'int',
    ];
}