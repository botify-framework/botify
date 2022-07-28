<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatAdministratorRights
 *
 * @method bool getIsAnonymous()
 * @method bool getCanManageChat()
 * @method bool getCanDeleteMessages()
 * @method bool getCanManageVideoChats()
 * @method bool getCanRestrictMembers()
 * @method bool getCanPromoteMembers()
 * @method bool getCanChangeInfo()
 * @method bool getCanInviteUsers()
 * @method bool getCanPostMessages()
 * @method bool getCanEditMessages()
 * @method bool getCanPinMessages()
 *
 * @method bool isIsAnonymous()
 * @method bool isCanManageChat()
 * @method bool isCanDeleteMessages()
 * @method bool isCanManageVideoChats()
 * @method bool isCanRestrictMembers()
 * @method bool isCanPromoteMembers()
 * @method bool isCanChangeInfo()
 * @method bool isCanInviteUsers()
 * @method bool isCanPostMessages()
 * @method bool isCanEditMessages()
 * @method bool isCanPinMessages()
 *
 * @method $this setIsAnonymous(bool $value)
 * @method $this setCanManageChat(bool $value)
 * @method $this setCanDeleteMessages(bool $value)
 * @method $this setCanManageVideoChats(bool $value)
 * @method $this setCanRestrictMembers(bool $value)
 * @method $this setCanPromoteMembers(bool $value)
 * @method $this setCanChangeInfo(bool $value)
 * @method $this setCanInviteUsers(bool $value)
 * @method $this setCanPostMessages(bool $value)
 * @method $this setCanEditMessages(bool $value)
 * @method $this setCanPinMessages(bool $value)
 *
 * @method $this unsetIsAnonymous()
 * @method $this unsetCanManageChat()
 * @method $this unsetCanDeleteMessages()
 * @method $this unsetCanManageVideoChats()
 * @method $this unsetCanRestrictMembers()
 * @method $this unsetCanPromoteMembers()
 * @method $this unsetCanChangeInfo()
 * @method $this unsetCanInviteUsers()
 * @method $this unsetCanPostMessages()
 * @method $this unsetCanEditMessages()
 * @method $this unsetCanPinMessages()
 *
 * @property bool $is_anonymous
 * @property bool $can_manage_chat
 * @property bool $can_delete_messages
 * @property bool $can_manage_video_chats
 * @property bool $can_restrict_members
 * @property bool $can_promote_members
 * @property bool $can_change_info
 * @property bool $can_invite_users
 * @property bool $can_post_messages
 * @property bool $can_edit_messages
 * @property bool $can_pin_messages
 */
class ChatAdministratorRights extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'is_anonymous' => 'bool',
        'can_manage_chat' => 'bool',
        'can_delete_messages' => 'bool',
        'can_manage_video_chats' => 'bool',
        'can_restrict_members' => 'bool',
        'can_promote_members' => 'bool',
        'can_change_info' => 'bool',
        'can_invite_users' => 'bool',
        'can_post_messages' => 'bool',
        'can_edit_messages' => 'bool',
        'can_pin_messages' => 'bool',
    ];
}