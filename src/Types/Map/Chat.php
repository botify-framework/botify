<?php

namespace Jove\Types\Map;

use Amp\Promise;
use Jove\Utils\LazyJsonMapper;

/**
 * Chat
 *
 * @method Int getId()
 * @method string getType()
 * @method string getTitle()
 * @method string getUsername()
 * @method string getFirstName()
 * @method string getLastName()
 * @method ChatPhoto getPhoto()
 * @method string getBio()
 * @method bool getHasPrivateForwards()
 * @method string getDescription()
 * @method string getInviteLink()
 * @method Message getPinnedMessage()
 * @method ChatPermissions getPermissions()
 * @method Int getSlowModeDelay()
 * @method Int getMessageAutoDeleteTime()
 * @method bool getHasProtectedContent()
 * @method string getStickerSetName()
 * @method bool getCanSetStickerSet()
 * @method Int getLinkedChatId()
 * @method ChatLocation getLocation()
 *
 * @method bool isId()
 * @method bool isType()
 * @method bool isTitle()
 * @method bool isUsername()
 * @method bool isFirstName()
 * @method bool isLastName()
 * @method bool isPhoto()
 * @method bool isBio()
 * @method bool isHasPrivateForwards()
 * @method bool isDescription()
 * @method bool isInviteLink()
 * @method bool isPinnedMessage()
 * @method bool isPermissions()
 * @method bool isSlowModeDelay()
 * @method bool isMessageAutoDeleteTime()
 * @method bool isHasProtectedContent()
 * @method bool isStickerSetName()
 * @method bool isCanSetStickerSet()
 * @method bool isLinkedChatId()
 * @method bool isLocation()
 *
 * @method $this setId(int $value)
 * @method $this setType(string $value)
 * @method $this setTitle(string $value)
 * @method $this setUsername(string $value)
 * @method $this setFirstName(string $value)
 * @method $this setLastName(string $value)
 * @method $this setPhoto(ChatPhoto $value)
 * @method $this setBio(string $value)
 * @method $this setHasPrivateForwards(bool $value)
 * @method $this setDescription(string $value)
 * @method $this setInviteLink(string $value)
 * @method $this setPinnedMessage(Message $value)
 * @method $this setPermissions(ChatPermissions $value)
 * @method $this setSlowModeDelay(int $value)
 * @method $this setMessageAutoDeleteTime(int $value)
 * @method $this setHasProtectedContent(bool $value)
 * @method $this setStickerSetName(string $value)
 * @method $this setCanSetStickerSet(bool $value)
 * @method $this setLinkedChatId(int $value)
 * @method $this setLocation(ChatLocation $value)
 *
 * @method $this unsetId()
 * @method $this unsetType()
 * @method $this unsetTitle()
 * @method $this unsetUsername()
 * @method $this unsetFirstName()
 * @method $this unsetLastName()
 * @method $this unsetPhoto()
 * @method $this unsetBio()
 * @method $this unsetHasPrivateForwards()
 * @method $this unsetDescription()
 * @method $this unsetInviteLink()
 * @method $this unsetPinnedMessage()
 * @method $this unsetPermissions()
 * @method $this unsetSlowModeDelay()
 * @method $this unsetMessageAutoDeleteTime()
 * @method $this unsetHasProtectedContent()
 * @method $this unsetStickerSetName()
 * @method $this unsetCanSetStickerSet()
 * @method $this unsetLinkedChatId()
 * @method $this unsetLocation()
 *
 * @property Int $id
 * @property string $type
 * @property string $title
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property ChatPhoto $photo
 * @property string $bio
 * @property bool $has_private_forwards
 * @property string $description
 * @property string $invite_link
 * @property Message $pinned_message
 * @property ChatPermissions $permissions
 * @property Int $slow_mode_delay
 * @property Int $message_auto_delete_time
 * @property bool $has_protected_content
 * @property string $sticker_set_name
 * @property bool $can_set_sticker_set
 * @property Int $linked_chat_id
 * @property ChatLocation $location
 */
class Chat extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'id' => 'int',
        'type' => 'string',
        'title' => 'string',
        'username' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'photo' => 'ChatPhoto',
        'bio' => 'string',
        'has_private_forwards' => 'bool',
        'description' => 'string',
        'invite_link' => 'string',
        'pinned_message' => 'Message',
        'permissions' => 'ChatPermissions',
        'slow_mode_delay' => 'int',
        'message_auto_delete_time' => 'int',
        'has_protected_content' => 'bool',
        'sticker_set_name' => 'string',
        'can_set_sticker_set' => 'bool',
        'linked_chat_id' => 'int',
        'location' => 'ChatLocation',
    ];

    /**
     * Getting specified user info in current chat
     *
     * @param $user_id
     * @return Promise<ChatMember>
     */
    public function getMember($user_id): Promise
    {
        return $this->api->getChatMember(
            chat_id: $this->id,
            user_id: $user_id
        );
    }
}