<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * User
 *
 * @method Int getId()
 * @method Bool getIsBot()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getUsername()
 * @method string getLanguageCode()
 * @method Bool getCanJoinGroups()
 * @method Bool getCanReadAllGroupMessages()
 * @method Bool getSupportsInlineQueries()
 *
 * @method bool isId()
 * @method bool isIsBot()
 * @method bool isFirstName()
 * @method bool isLastName()
 * @method bool isUsername()
 * @method bool isLanguageCode()
 * @method bool isCanJoinGroups()
 * @method bool isCanReadAllGroupMessages()
 * @method bool isSupportsInlineQueries()
 *
 * @method $this setId(int $value)
 * @method $this setIsBot(bool $value)
 * @method $this setFirstName(string $value)
 * @method $this setLastName(string $value)
 * @method $this setUsername(string $value)
 * @method $this setLanguageCode(string $value)
 * @method $this setCanJoinGroups(bool $value)
 * @method $this setCanReadAllGroupMessages(bool $value)
 * @method $this setSupportsInlineQueries(bool $value)
 *
 * @method $this unsetId()
 * @method $this unsetIsBot()
 * @method $this unsetFirstName()
 * @method $this unsetLastName()
 * @method $this unsetUsername()
 * @method $this unsetLanguageCode()
 * @method $this unsetCanJoinGroups()
 * @method $this unsetCanReadAllGroupMessages()
 * @method $this unsetSupportsInlineQueries()
 *
 * @property Int $id
 * @property Bool $is_bot
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $language_code
 * @property Bool $can_join_groups
 * @property Bool $can_read_all_group_messages
 * @property Bool $supports_inline_queries
 */
class User extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'id' => 'int',
        'is_bot' => 'Bool',
        'first_name' => 'string',
        'last_name' => 'string',
        'username' => 'string',
        'language_code' => 'string',
        'can_join_groups' => 'Bool',
        'can_read_all_group_messages' => 'Bool',
        'supports_inline_queries' => 'Bool',
    ];
}