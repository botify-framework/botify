<?php
namespace Jove\Types\Map;

use Amp\Promise;
use Jove\Utils\LazyJsonMapper;

/**
 * Message
 *
 * @method Int getMessageId()
 * @method User getFrom()
 * @method Chat getSenderChat()
 * @method Int getDate()
 * @method Chat getChat()
 * @method User getForwardFrom()
 * @method Chat getForwardFromChat()
 * @method Int getForwardFromMessageId()
 * @method string getForwardSignature()
 * @method string getForwardSenderName()
 * @method Int getForwardDate()
 * @method Bool getIsAutomaticForward()
 * @method Message getReplyToMessage()
 * @method User getViaBot()
 * @method Int getEditDate()
 * @method Bool getHasProtectedContent()
 * @method string getMediaGroupId()
 * @method string getAuthorSignature()
 * @method string getText()
 * @method MessageEntity[] getEntities()
 * @method Animation getAnimation()
 * @method Audio getAudio()
 * @method Document getDocument()
 * @method PhotoSize[] getPhoto()
 * @method Sticker getSticker()
 * @method Video getVideo()
 * @method VideoNote getVideoNote()
 * @method Voice getVoice()
 * @method string getCaption()
 * @method MessageEntity[] getCaptionEntities()
 * @method Contact getContact()
 * @method Dice getDice()
 * @method Game getGame()
 * @method Poll getPoll()
 * @method Venue getVenue()
 * @method Location getLocation()
 * @method User[] getNewChatMembers()
 * @method User getLeftChatMember()
 * @method string getNewChatTitle()
 * @method PhotoSize[] getNewChatPhoto()
 * @method Bool getDeleteChatPhoto()
 * @method Bool getGroupChatCreated()
 * @method Bool getSupergroupChatCreated()
 * @method Bool getChannelChatCreated()
 * @method MessageAutoDeleteTimerChanged getMessageAutoDeleteTimerChanged()
 * @method Int getMigrateToChatId()
 * @method Int getMigrateFromChatId()
 * @method Message getPinnedMessage()
 * @method Invoice getInvoice()
 * @method SuccessfulPayment getSuccessfulPayment()
 * @method string getConnectedWebsite()
 * @method PassportData getPassportData()
 * @method ProximityAlertTriggered getProximityAlertTriggered()
 * @method VideoChatScheduled getVideoChatScheduled()
 * @method VideoChatStarted getVideoChatStarted()
 * @method VideoChatEnded getVideoChatEnded()
 * @method VideoChatParticipantsInvited getVideoChatParticipantsInvited()
 * @method WebAppData getWebAppData()
 * @method InlineKeyboardMarkup getReplyMarkup()
 *
 * @method bool isMessageId()
 * @method bool isFrom()
 * @method bool isSenderChat()
 * @method bool isDate()
 * @method bool isChat()
 * @method bool isForwardFrom()
 * @method bool isForwardFromChat()
 * @method bool isForwardFromMessageId()
 * @method bool isForwardSignature()
 * @method bool isForwardSenderName()
 * @method bool isForwardDate()
 * @method bool isIsAutomaticForward()
 * @method bool isReplyToMessage()
 * @method bool isViaBot()
 * @method bool isEditDate()
 * @method bool isHasProtectedContent()
 * @method bool isMediaGroupId()
 * @method bool isAuthorSignature()
 * @method bool isText()
 * @method bool isEntities()
 * @method bool isAnimation()
 * @method bool isAudio()
 * @method bool isDocument()
 * @method bool isPhoto()
 * @method bool isSticker()
 * @method bool isVideo()
 * @method bool isVideoNote()
 * @method bool isVoice()
 * @method bool isCaption()
 * @method bool isCaptionEntities()
 * @method bool isContact()
 * @method bool isDice()
 * @method bool isGame()
 * @method bool isPoll()
 * @method bool isVenue()
 * @method bool isLocation()
 * @method bool isNewChatMembers()
 * @method bool isLeftChatMember()
 * @method bool isNewChatTitle()
 * @method bool isNewChatPhoto()
 * @method bool isDeleteChatPhoto()
 * @method bool isGroupChatCreated()
 * @method bool isSupergroupChatCreated()
 * @method bool isChannelChatCreated()
 * @method bool isMessageAutoDeleteTimerChanged()
 * @method bool isMigrateToChatId()
 * @method bool isMigrateFromChatId()
 * @method bool isPinnedMessage()
 * @method bool isInvoice()
 * @method bool isSuccessfulPayment()
 * @method bool isConnectedWebsite()
 * @method bool isPassportData()
 * @method bool isProximityAlertTriggered()
 * @method bool isVideoChatScheduled()
 * @method bool isVideoChatStarted()
 * @method bool isVideoChatEnded()
 * @method bool isVideoChatParticipantsInvited()
 * @method bool isWebAppData()
 * @method bool isReplyMarkup()
 *
 * @method $this setMessageId(int $value)
 * @method $this setFrom(User $value)
 * @method $this setSenderChat(Chat $value)
 * @method $this setDate(int $value)
 * @method $this setChat(Chat $value)
 * @method $this setForwardFrom(User $value)
 * @method $this setForwardFromChat(Chat $value)
 * @method $this setForwardFromMessageId(int $value)
 * @method $this setForwardSignature(string $value)
 * @method $this setForwardSenderName(string $value)
 * @method $this setForwardDate(int $value)
 * @method $this setIsAutomaticForward(bool $value)
 * @method $this setReplyToMessage(Message $value)
 * @method $this setViaBot(User $value)
 * @method $this setEditDate(int $value)
 * @method $this setHasProtectedContent(bool $value)
 * @method $this setMediaGroupId(string $value)
 * @method $this setAuthorSignature(string $value)
 * @method $this setText(string $value)
 * @method $this setEntities(MessageEntity[] $value)
 * @method $this setAnimation(Animation $value)
 * @method $this setAudio(Audio $value)
 * @method $this setDocument(Document $value)
 * @method $this setPhoto(PhotoSize[] $value)
 * @method $this setSticker(Sticker $value)
 * @method $this setVideo(Video $value)
 * @method $this setVideoNote(VideoNote $value)
 * @method $this setVoice(Voice $value)
 * @method $this setCaption(string $value)
 * @method $this setCaptionEntities(MessageEntity[] $value)
 * @method $this setContact(Contact $value)
 * @method $this setDice(Dice $value)
 * @method $this setGame(Game $value)
 * @method $this setPoll(Poll $value)
 * @method $this setVenue(Venue $value)
 * @method $this setLocation(Location $value)
 * @method $this setNewChatMembers(User[] $value)
 * @method $this setLeftChatMember(User $value)
 * @method $this setNewChatTitle(string $value)
 * @method $this setNewChatPhoto(PhotoSize[] $value)
 * @method $this setDeleteChatPhoto(bool $value)
 * @method $this setGroupChatCreated(bool $value)
 * @method $this setSupergroupChatCreated(bool $value)
 * @method $this setChannelChatCreated(bool $value)
 * @method $this setMessageAutoDeleteTimerChanged(MessageAutoDeleteTimerChanged $value)
 * @method $this setMigrateToChatId(int $value)
 * @method $this setMigrateFromChatId(int $value)
 * @method $this setPinnedMessage(Message $value)
 * @method $this setInvoice(Invoice $value)
 * @method $this setSuccessfulPayment(SuccessfulPayment $value)
 * @method $this setConnectedWebsite(string $value)
 * @method $this setPassportData(PassportData $value)
 * @method $this setProximityAlertTriggered(ProximityAlertTriggered $value)
 * @method $this setVideoChatScheduled(VideoChatScheduled $value)
 * @method $this setVideoChatStarted(VideoChatStarted $value)
 * @method $this setVideoChatEnded(VideoChatEnded $value)
 * @method $this setVideoChatParticipantsInvited(VideoChatParticipantsInvited $value)
 * @method $this setWebAppData(WebAppData $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 *
 * @method $this unsetMessageId()
 * @method $this unsetFrom()
 * @method $this unsetSenderChat()
 * @method $this unsetDate()
 * @method $this unsetChat()
 * @method $this unsetForwardFrom()
 * @method $this unsetForwardFromChat()
 * @method $this unsetForwardFromMessageId()
 * @method $this unsetForwardSignature()
 * @method $this unsetForwardSenderName()
 * @method $this unsetForwardDate()
 * @method $this unsetIsAutomaticForward()
 * @method $this unsetReplyToMessage()
 * @method $this unsetViaBot()
 * @method $this unsetEditDate()
 * @method $this unsetHasProtectedContent()
 * @method $this unsetMediaGroupId()
 * @method $this unsetAuthorSignature()
 * @method $this unsetText()
 * @method $this unsetEntities()
 * @method $this unsetAnimation()
 * @method $this unsetAudio()
 * @method $this unsetDocument()
 * @method $this unsetPhoto()
 * @method $this unsetSticker()
 * @method $this unsetVideo()
 * @method $this unsetVideoNote()
 * @method $this unsetVoice()
 * @method $this unsetCaption()
 * @method $this unsetCaptionEntities()
 * @method $this unsetContact()
 * @method $this unsetDice()
 * @method $this unsetGame()
 * @method $this unsetPoll()
 * @method $this unsetVenue()
 * @method $this unsetLocation()
 * @method $this unsetNewChatMembers()
 * @method $this unsetLeftChatMember()
 * @method $this unsetNewChatTitle()
 * @method $this unsetNewChatPhoto()
 * @method $this unsetDeleteChatPhoto()
 * @method $this unsetGroupChatCreated()
 * @method $this unsetSupergroupChatCreated()
 * @method $this unsetChannelChatCreated()
 * @method $this unsetMessageAutoDeleteTimerChanged()
 * @method $this unsetMigrateToChatId()
 * @method $this unsetMigrateFromChatId()
 * @method $this unsetPinnedMessage()
 * @method $this unsetInvoice()
 * @method $this unsetSuccessfulPayment()
 * @method $this unsetConnectedWebsite()
 * @method $this unsetPassportData()
 * @method $this unsetProximityAlertTriggered()
 * @method $this unsetVideoChatScheduled()
 * @method $this unsetVideoChatStarted()
 * @method $this unsetVideoChatEnded()
 * @method $this unsetVideoChatParticipantsInvited()
 * @method $this unsetWebAppData()
 * @method $this unsetReplyMarkup()
 *
 * @property Int $message_id
 * @property User $from
 * @property Chat $sender_chat
 * @property Int $date
 * @property Chat $chat
 * @property User $forward_from
 * @property Chat $forward_from_chat
 * @property Int $forward_from_message_id
 * @property string $forward_signature
 * @property string $forward_sender_name
 * @property Int $forward_date
 * @property Bool $is_automatic_forward
 * @property Message $reply_to_message
 * @property User $via_bot
 * @property Int $edit_date
 * @property Bool $has_protected_content
 * @property string $media_group_id
 * @property string $author_signature
 * @property string $text
 * @property MessageEntity[] $entities
 * @property Animation $animation
 * @property Audio $audio
 * @property Document $document
 * @property PhotoSize[] $photo
 * @property Sticker $sticker
 * @property Video $video
 * @property VideoNote $video_note
 * @property Voice $voice
 * @property string $caption
 * @property MessageEntity[] $caption_entities
 * @property Contact $contact
 * @property Dice $dice
 * @property Game $game
 * @property Poll $poll
 * @property Venue $venue
 * @property Location $location
 * @property User[] $new_chat_members
 * @property User $left_chat_member
 * @property string $new_chat_title
 * @property PhotoSize[] $new_chat_photo
 * @property Bool $delete_chat_photo
 * @property Bool $group_chat_created
 * @property Bool $supergroup_chat_created
 * @property Bool $channel_chat_created
 * @property MessageAutoDeleteTimerChanged $message_auto_delete_timer_changed
 * @property Int $migrate_to_chat_id
 * @property Int $migrate_from_chat_id
 * @property Message $pinned_message
 * @property Invoice $invoice
 * @property SuccessfulPayment $successful_payment
 * @property string $connected_website
 * @property PassportData $passport_data
 * @property ProximityAlertTriggered $proximity_alert_triggered
 * @property VideoChatScheduled $video_chat_scheduled
 * @property VideoChatStarted $video_chat_started
 * @property VideoChatEnded $video_chat_ended
 * @property VideoChatParticipantsInvited $video_chat_participants_invited
 * @property WebAppData $web_app_data
 * @property InlineKeyboardMarkup $reply_markup
 */


class Message extends LazyJsonMapper{

	const JSON_PROPERTY_MAP = [
		'message_id' => 'int',
		'from' => 'User',
		'sender_chat' => 'Chat',
		'date' => 'int',
		'chat' => 'Chat',
		'forward_from' => 'User',
		'forward_from_chat' => 'Chat',
		'forward_from_message_id' => 'int',
		'forward_signature' => 'string',
		'forward_sender_name' => 'string',
		'forward_date' => 'int',
		'is_automatic_forward' => 'Bool',
		'reply_to_message' => 'Message',
		'via_bot' => 'User',
		'edit_date' => 'int',
		'has_protected_content' => 'Bool',
		'media_group_id' => 'string',
		'author_signature' => 'string',
		'text' => 'string',
		'entities' => 'MessageEntity[]',
		'animation' => 'Animation',
		'audio' => 'Audio',
		'document' => 'Document',
		'photo' => 'PhotoSize[]',
		'sticker' => 'Sticker',
		'video' => 'Video',
		'video_note' => 'VideoNote',
		'voice' => 'Voice',
		'caption' => 'string',
		'caption_entities' => 'MessageEntity[]',
		'contact' => 'Contact',
		'dice' => 'Dice',
		'game' => 'Game',
		'poll' => 'Poll',
		'venue' => 'Venue',
		'location' => 'Location',
		'new_chat_members' => 'User[]',
		'left_chat_member' => 'User',
		'new_chat_title' => 'string',
		'new_chat_photo' => 'PhotoSize[]',
		'delete_chat_photo' => 'Bool',
		'group_chat_created' => 'Bool',
		'supergroup_chat_created' => 'Bool',
		'channel_chat_created' => 'Bool',
		'message_auto_delete_timer_changed' => 'MessageAutoDeleteTimerChanged',
		'migrate_to_chat_id' => 'int',
		'migrate_from_chat_id' => 'int',
		'pinned_message' => 'Message',
		'invoice' => 'Invoice',
		'successful_payment' => 'SuccessfulPayment',
		'connected_website' => 'string',
		'passport_data' => 'PassportData',
		'proximity_alert_triggered' => 'ProximityAlertTriggered',
		'video_chat_scheduled' => 'VideoChatScheduled',
		'video_chat_started' => 'VideoChatStarted',
		'video_chat_ended' => 'VideoChatEnded',
		'video_chat_participants_invited' => 'VideoChatParticipantsInvited',
		'web_app_data' => 'WebAppData',
		'reply_markup' => 'InlineKeyboardMarkup',
	];

    public function _init()
    {
        parent::_init();

        $this->id = $this->_getProperty('message_id');
    }

    /**
     * @return Promise
     */
    public function delete(): Promise
    {
        return $this->api->deleteMessage(
            $this->chat->id,
            $this->id,
        );
    }

    public function edit($text): Promise
    {
        return $this->api->editMessageText(
            $this->chat->id,
            $this->id,
            $text
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_getProperty('message_id');
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return strtr(strtr($this->_getProperty('text'), [
            '۰' => '0',
            '۱' => '1',
            '۲' => '2',
            '۳' => '3',
            '۴' => '4',
            '۵' => '5',
            '۶' => '6',
            '۷' => '7',
            '۸' => '8',
            '۹' => '9',
        ]), [
            '٠' => '0',
            '١' => '1',
            '٢' => '2',
            '٣' => '3',
            '٤' => '4',
            '٥' => '5',
            '٦' => '6',
            '٧' => '7',
            '٨' => '8',
            '٩' => '9',
        ]);
    }
}