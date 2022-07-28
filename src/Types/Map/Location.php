<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * Location
 *
 * @method Float getLongitude()
 * @method Float getLatitude()
 * @method Float getHorizontalAccuracy()
 * @method Int getLivePeriod()
 * @method Int getHeading()
 * @method Int getProximityAlertRadius()
 *
 * @method bool isLongitude()
 * @method bool isLatitude()
 * @method bool isHorizontalAccuracy()
 * @method bool isLivePeriod()
 * @method bool isHeading()
 * @method bool isProximityAlertRadius()
 *
 * @method $this setLongitude(float $value)
 * @method $this setLatitude(float $value)
 * @method $this setHorizontalAccuracy(float $value)
 * @method $this setLivePeriod(int $value)
 * @method $this setHeading(int $value)
 * @method $this setProximityAlertRadius(int $value)
 *
 * @method $this unsetLongitude()
 * @method $this unsetLatitude()
 * @method $this unsetHorizontalAccuracy()
 * @method $this unsetLivePeriod()
 * @method $this unsetHeading()
 * @method $this unsetProximityAlertRadius()
 *
 * @property Float $longitude
 * @property Float $latitude
 * @property Float $horizontal_accuracy
 * @property Int $live_period
 * @property Int $heading
 * @property Int $proximity_alert_radius
 */
class Location extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'longitude' => 'float',
        'latitude' => 'float',
        'horizontal_accuracy' => 'float',
        'live_period' => 'int',
        'heading' => 'int',
        'proximity_alert_radius' => 'int',
    ];
}