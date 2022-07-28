<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * UserProfilePhotos
 *
 * @method Int getTotalCount()
 * @method PhotoSize[] getPhotos()
 *
 * @method bool isTotalCount()
 * @method bool isPhotos()
 *
 * @method $this setTotalCount(int $value)
 * @method $this setPhotos(PhotoSize[] $value)
 *
 * @method $this unsetTotalCount()
 * @method $this unsetPhotos()
 *
 * @property Int $total_count
 * @property PhotoSize[] $photos
 */
class UserProfilePhotos extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'total_count' => 'int',
        'photos' => 'PhotoSize[][]',
    ];
}