<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatMemberUpdated
 *
 * @method Chat getChat()
 * @method User getFrom()
 * @method Int getDate()
 * @method ChatMember getOldChatMember()
 * @method ChatMember getNewChatMember()
 * @method ChatInviteLink getInviteLink()
 *
 * @method bool isChat()
 * @method bool isFrom()
 * @method bool isDate()
 * @method bool isOldChatMember()
 * @method bool isNewChatMember()
 * @method bool isInviteLink()
 *
 * @method $this setChat(Chat $value)
 * @method $this setFrom(User $value)
 * @method $this setDate(int $value)
 * @method $this setOldChatMember(ChatMember $value)
 * @method $this setNewChatMember(ChatMember $value)
 * @method $this setInviteLink(ChatInviteLink $value)
 *
 * @method $this unsetChat()
 * @method $this unsetFrom()
 * @method $this unsetDate()
 * @method $this unsetOldChatMember()
 * @method $this unsetNewChatMember()
 * @method $this unsetInviteLink()
 *
 * @property Chat $chat
 * @property User $from
 * @property Int $date
 * @property ChatMember $old_chat_member
 * @property ChatMember $new_chat_member
 * @property ChatInviteLink $invite_link
 */
class ChatMemberUpdated extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'chat' => 'Chat',
        'from' => 'User',
        'date' => 'int',
        'old_chat_member' => 'ChatMember',
        'new_chat_member' => 'ChatMember',
        'invite_link' => 'ChatInviteLink',
    ];
}