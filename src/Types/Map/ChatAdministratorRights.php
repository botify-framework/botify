<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * ChatAdministratorRights
 *
 * @method Bool getIsAnonymous()
 * @method Bool getCanManageChat()
 * @method Bool getCanDeleteMessages()
 * @method Bool getCanManageVideoChats()
 * @method Bool getCanRestrictMembers()
 * @method Bool getCanPromoteMembers()
 * @method Bool getCanChangeInfo()
 * @method Bool getCanInviteUsers()
 * @method Bool getCanPostMessages()
 * @method Bool getCanEditMessages()
 * @method Bool getCanPinMessages()
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
 * @property Bool $is_anonymous
 * @property Bool $can_manage_chat
 * @property Bool $can_delete_messages
 * @property Bool $can_manage_video_chats
 * @property Bool $can_restrict_members
 * @property Bool $can_promote_members
 * @property Bool $can_change_info
 * @property Bool $can_invite_users
 * @property Bool $can_post_messages
 * @property Bool $can_edit_messages
 * @property Bool $can_pin_messages
 */
class ChatAdministratorRights extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'is_anonymous' => 'Bool',
        'can_manage_chat' => 'Bool',
        'can_delete_messages' => 'Bool',
        'can_manage_video_chats' => 'Bool',
        'can_restrict_members' => 'Bool',
        'can_promote_members' => 'Bool',
        'can_change_info' => 'Bool',
        'can_invite_users' => 'Bool',
        'can_post_messages' => 'Bool',
        'can_edit_messages' => 'Bool',
        'can_pin_messages' => 'Bool',
    ];
}