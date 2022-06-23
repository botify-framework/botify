<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * ChatMemberAdministrator
 *
 * @method string getStatus()
 * @method User getUser()
 * @method Bool getCanBeEdited()
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
 * @method string getCustomTitle()
 *
 * @method bool isStatus()
 * @method bool isUser()
 * @method bool isCanBeEdited()
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
 * @method bool isCustomTitle()
 *
 * @method $this setStatus(string $value)
 * @method $this setUser(User $value)
 * @method $this setCanBeEdited(bool $value)
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
 * @method $this setCustomTitle(string $value)
 *
 * @method $this unsetStatus()
 * @method $this unsetUser()
 * @method $this unsetCanBeEdited()
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
 * @method $this unsetCustomTitle()
 *
 * @property string $status
 * @property User $user
 * @property Bool $can_be_edited
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
 * @property string $custom_title
 */
class ChatMemberAdministrator extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user' => 'User',
        'can_be_edited' => 'Bool',
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
        'custom_title' => 'string',
    ];
}