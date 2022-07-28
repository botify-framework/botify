<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatPermissions
 *
 * @method bool getCanSendMessages()
 * @method bool getCanSendMediaMessages()
 * @method bool getCanSendPolls()
 * @method bool getCanSendOtherMessages()
 * @method bool getCanAddWebPagePreviews()
 * @method bool getCanChangeInfo()
 * @method bool getCanInviteUsers()
 * @method bool getCanPinMessages()
 *
 * @method bool isCanSendMessages()
 * @method bool isCanSendMediaMessages()
 * @method bool isCanSendPolls()
 * @method bool isCanSendOtherMessages()
 * @method bool isCanAddWebPagePreviews()
 * @method bool isCanChangeInfo()
 * @method bool isCanInviteUsers()
 * @method bool isCanPinMessages()
 *
 * @method $this setCanSendMessages(bool $value)
 * @method $this setCanSendMediaMessages(bool $value)
 * @method $this setCanSendPolls(bool $value)
 * @method $this setCanSendOtherMessages(bool $value)
 * @method $this setCanAddWebPagePreviews(bool $value)
 * @method $this setCanChangeInfo(bool $value)
 * @method $this setCanInviteUsers(bool $value)
 * @method $this setCanPinMessages(bool $value)
 *
 * @method $this unsetCanSendMessages()
 * @method $this unsetCanSendMediaMessages()
 * @method $this unsetCanSendPolls()
 * @method $this unsetCanSendOtherMessages()
 * @method $this unsetCanAddWebPagePreviews()
 * @method $this unsetCanChangeInfo()
 * @method $this unsetCanInviteUsers()
 * @method $this unsetCanPinMessages()
 *
 * @property bool $can_send_messages
 * @property bool $can_send_media_messages
 * @property bool $can_send_polls
 * @property bool $can_send_other_messages
 * @property bool $can_add_web_page_previews
 * @property bool $can_change_info
 * @property bool $can_invite_users
 * @property bool $can_pin_messages
 */
class ChatPermissions extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'can_send_messages' => 'bool',
        'can_send_media_messages' => 'bool',
        'can_send_polls' => 'bool',
        'can_send_other_messages' => 'bool',
        'can_add_web_page_previews' => 'bool',
        'can_change_info' => 'bool',
        'can_invite_users' => 'bool',
        'can_pin_messages' => 'bool',
    ];
}