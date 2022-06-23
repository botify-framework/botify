<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * ChatMemberRestricted
 *
 * @method string getStatus()
 * @method User getUser()
 * @method Bool getIsMember()
 * @method Bool getCanChangeInfo()
 * @method Bool getCanInviteUsers()
 * @method Bool getCanPinMessages()
 * @method Bool getCanSendMessages()
 * @method Bool getCanSendMediaMessages()
 * @method Bool getCanSendPolls()
 * @method Bool getCanSendOtherMessages()
 * @method Bool getCanAddWebPagePreviews()
 * @method Int getUntilDate()
 *
 * @method bool isStatus()
 * @method bool isUser()
 * @method bool isIsMember()
 * @method bool isCanChangeInfo()
 * @method bool isCanInviteUsers()
 * @method bool isCanPinMessages()
 * @method bool isCanSendMessages()
 * @method bool isCanSendMediaMessages()
 * @method bool isCanSendPolls()
 * @method bool isCanSendOtherMessages()
 * @method bool isCanAddWebPagePreviews()
 * @method bool isUntilDate()
 *
 * @method $this setStatus(string $value)
 * @method $this setUser(User $value)
 * @method $this setIsMember(bool $value)
 * @method $this setCanChangeInfo(bool $value)
 * @method $this setCanInviteUsers(bool $value)
 * @method $this setCanPinMessages(bool $value)
 * @method $this setCanSendMessages(bool $value)
 * @method $this setCanSendMediaMessages(bool $value)
 * @method $this setCanSendPolls(bool $value)
 * @method $this setCanSendOtherMessages(bool $value)
 * @method $this setCanAddWebPagePreviews(bool $value)
 * @method $this setUntilDate(int $value)
 *
 * @method $this unsetStatus()
 * @method $this unsetUser()
 * @method $this unsetIsMember()
 * @method $this unsetCanChangeInfo()
 * @method $this unsetCanInviteUsers()
 * @method $this unsetCanPinMessages()
 * @method $this unsetCanSendMessages()
 * @method $this unsetCanSendMediaMessages()
 * @method $this unsetCanSendPolls()
 * @method $this unsetCanSendOtherMessages()
 * @method $this unsetCanAddWebPagePreviews()
 * @method $this unsetUntilDate()
 *
 * @property string $status
 * @property User $user
 * @property Bool $is_member
 * @property Bool $can_change_info
 * @property Bool $can_invite_users
 * @property Bool $can_pin_messages
 * @property Bool $can_send_messages
 * @property Bool $can_send_media_messages
 * @property Bool $can_send_polls
 * @property Bool $can_send_other_messages
 * @property Bool $can_add_web_page_previews
 * @property Int $until_date
 */

class ChatMemberRestricted extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'status' => 'string',		'user' => 'User',		'is_member' => 'Bool',		'can_change_info' => 'Bool',		'can_invite_users' => 'Bool',		'can_pin_messages' => 'Bool',		'can_send_messages' => 'Bool',		'can_send_media_messages' => 'Bool',		'can_send_polls' => 'Bool',		'can_send_other_messages' => 'Bool',		'can_add_web_page_previews' => 'Bool',		'until_date' => 'int',	];
}