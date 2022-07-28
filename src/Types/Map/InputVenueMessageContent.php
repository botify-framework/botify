<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputVenueMessageContent
 *
 * @method Float getLatitude()
 * @method Float getLongitude()
 * @method string getTitle()
 * @method string getAddress()
 * @method string getFoursquareId()
 * @method string getFoursquareType()
 * @method string getGooglePlaceId()
 * @method string getGooglePlaceType()
 *
 * @method bool isLatitude()
 * @method bool isLongitude()
 * @method bool isTitle()
 * @method bool isAddress()
 * @method bool isFoursquareId()
 * @method bool isFoursquareType()
 * @method bool isGooglePlaceId()
 * @method bool isGooglePlaceType()
 *
 * @method $this setLatitude(float $value)
 * @method $this setLongitude(float $value)
 * @method $this setTitle(string $value)
 * @method $this setAddress(string $value)
 * @method $this setFoursquareId(string $value)
 * @method $this setFoursquareType(string $value)
 * @method $this setGooglePlaceId(string $value)
 * @method $this setGooglePlaceType(string $value)
 *
 * @method $this unsetLatitude()
 * @method $this unsetLongitude()
 * @method $this unsetTitle()
 * @method $this unsetAddress()
 * @method $this unsetFoursquareId()
 * @method $this unsetFoursquareType()
 * @method $this unsetGooglePlaceId()
 * @method $this unsetGooglePlaceType()
 *
 * @property Float $latitude
 * @property Float $longitude
 * @property string $title
 * @property string $address
 * @property string $foursquare_id
 * @property string $foursquare_type
 * @property string $google_place_id
 * @property string $google_place_type
 */
class InputVenueMessageContent extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'latitude' => 'float',
        'longitude' => 'float',
        'title' => 'string',
        'address' => 'string',
        'foursquare_id' => 'string',
        'foursquare_type' => 'string',
        'google_place_id' => 'string',
        'google_place_type' => 'string',
    ];
}