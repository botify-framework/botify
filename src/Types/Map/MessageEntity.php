<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * MessageEntity
 *
 * @method string getType()
 * @method Int getOffset()
 * @method Int getLength()
 * @method string getUrl()
 * @method User getUser()
 * @method string getLanguage()
 *
 * @method bool isType()
 * @method bool isOffset()
 * @method bool isLength()
 * @method bool isUrl()
 * @method bool isUser()
 * @method bool isLanguage()
 *
 * @method $this setType(string $value)
 * @method $this setOffset(int $value)
 * @method $this setLength(int $value)
 * @method $this setUrl(string $value)
 * @method $this setUser(User $value)
 * @method $this setLanguage(string $value)
 *
 * @method $this unsetType()
 * @method $this unsetOffset()
 * @method $this unsetLength()
 * @method $this unsetUrl()
 * @method $this unsetUser()
 * @method $this unsetLanguage()
 *
 * @property string $type
 * @property Int $offset
 * @property Int $length
 * @property string $url
 * @property User $user
 * @property string $language
 */
class MessageEntity extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'offset' => 'int',
        'length' => 'int',
        'url' => 'string',
        'user' => 'User',
        'language' => 'string',
    ];
}