<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatInviteLink
 *
 * @method string getInviteLink()
 * @method User getCreator()
 * @method bool getCreatesJoinRequest()
 * @method bool getIsPrimary()
 * @method bool getIsRevoked()
 * @method string getName()
 * @method Int getExpireDate()
 * @method Int getMemberLimit()
 * @method Int getPendingJoinRequestCount()
 *
 * @method bool isInviteLink()
 * @method bool isCreator()
 * @method bool isCreatesJoinRequest()
 * @method bool isIsPrimary()
 * @method bool isIsRevoked()
 * @method bool isName()
 * @method bool isExpireDate()
 * @method bool isMemberLimit()
 * @method bool isPendingJoinRequestCount()
 *
 * @method $this setInviteLink(string $value)
 * @method $this setCreator(User $value)
 * @method $this setCreatesJoinRequest(bool $value)
 * @method $this setIsPrimary(bool $value)
 * @method $this setIsRevoked(bool $value)
 * @method $this setName(string $value)
 * @method $this setExpireDate(int $value)
 * @method $this setMemberLimit(int $value)
 * @method $this setPendingJoinRequestCount(int $value)
 *
 * @method $this unsetInviteLink()
 * @method $this unsetCreator()
 * @method $this unsetCreatesJoinRequest()
 * @method $this unsetIsPrimary()
 * @method $this unsetIsRevoked()
 * @method $this unsetName()
 * @method $this unsetExpireDate()
 * @method $this unsetMemberLimit()
 * @method $this unsetPendingJoinRequestCount()
 *
 * @property string $invite_link
 * @property User $creator
 * @property bool $creates_join_request
 * @property bool $is_primary
 * @property bool $is_revoked
 * @property string $name
 * @property Int $expire_date
 * @property Int $member_limit
 * @property Int $pending_join_request_count
 */
class ChatInviteLink extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'invite_link' => 'string',
        'creator' => 'User',
        'creates_join_request' => 'bool',
        'is_primary' => 'bool',
        'is_revoked' => 'bool',
        'name' => 'string',
        'expire_date' => 'int',
        'member_limit' => 'int',
        'pending_join_request_count' => 'int',
    ];
}