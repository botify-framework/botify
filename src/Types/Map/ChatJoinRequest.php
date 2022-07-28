<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * ChatJoinRequest
 *
 * @method Chat getChat()
 * @method User getFrom()
 * @method Int getDate()
 * @method string getBio()
 * @method ChatInviteLink getInviteLink()
 *
 * @method bool isChat()
 * @method bool isFrom()
 * @method bool isDate()
 * @method bool isBio()
 * @method bool isInviteLink()
 *
 * @method $this setChat(Chat $value)
 * @method $this setFrom(User $value)
 * @method $this setDate(int $value)
 * @method $this setBio(string $value)
 * @method $this setInviteLink(ChatInviteLink $value)
 *
 * @method $this unsetChat()
 * @method $this unsetFrom()
 * @method $this unsetDate()
 * @method $this unsetBio()
 * @method $this unsetInviteLink()
 *
 * @property Chat $chat
 * @property User $from
 * @property Int $date
 * @property string $bio
 * @property ChatInviteLink $invite_link
 */
class ChatJoinRequest extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'chat' => 'Chat',
        'from' => 'User',
        'date' => 'int',
        'bio' => 'string',
        'invite_link' => 'ChatInviteLink',
    ];
}