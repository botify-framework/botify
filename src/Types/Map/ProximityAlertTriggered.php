<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ProximityAlertTriggered
 *
 * @method User getTraveler()
 * @method User getWatcher()
 * @method Int getDistance()
 *
 * @method bool isTraveler()
 * @method bool isWatcher()
 * @method bool isDistance()
 *
 * @method $this setTraveler(User $value)
 * @method $this setWatcher(User $value)
 * @method $this setDistance(int $value)
 *
 * @method $this unsetTraveler()
 * @method $this unsetWatcher()
 * @method $this unsetDistance()
 *
 * @property User $traveler
 * @property User $watcher
 * @property Int $distance
 */
class ProximityAlertTriggered extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'traveler' => 'User',
        'watcher' => 'User',
        'distance' => 'int',
    ];
}