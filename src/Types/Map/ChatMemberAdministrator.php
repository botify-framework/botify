<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatMemberAdministrator
 *
 * @method string getStatus()
 * @method User getUser()
 * @method bool getCanBeEdited()
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
 * @property bool $can_be_edited
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
 * @property string $custom_title
 */
class ChatMemberAdministrator extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user' => 'User',
        'can_be_edited' => 'bool',
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
        'custom_title' => 'string',
    ];
}