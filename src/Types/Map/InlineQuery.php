<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQuery
 *
 * @method string getId()
 * @method User getFrom()
 * @method string getQuery()
 * @method string getOffset()
 * @method string getChatType()
 * @method Location getLocation()
 *
 * @method bool isId()
 * @method bool isFrom()
 * @method bool isQuery()
 * @method bool isOffset()
 * @method bool isChatType()
 * @method bool isLocation()
 *
 * @method $this setId(string $value)
 * @method $this setFrom(User $value)
 * @method $this setQuery(string $value)
 * @method $this setOffset(string $value)
 * @method $this setChatType(string $value)
 * @method $this setLocation(Location $value)
 *
 * @method $this unsetId()
 * @method $this unsetFrom()
 * @method $this unsetQuery()
 * @method $this unsetOffset()
 * @method $this unsetChatType()
 * @method $this unsetLocation()
 *
 * @property string $id
 * @property User $from
 * @property string $query
 * @property string $offset
 * @property string $chat_type
 * @property Location $location
 */
class InlineQuery extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'from' => 'User',
        'query' => 'string',
        'offset' => 'string',
        'chat_type' => 'string',
        'location' => 'Location',
    ];
}