<?php

namespace Jove\Types\Map;

use Amp\Promise;
use Jove\Utils\LazyJsonMapper;
use function Amp\call;
use function Amp\File\createDirectoryRecursively;
use function Amp\File\isDirectory;
use function Amp\File\openFile;

/**
 * Message
 *
 * @method Int getId()
 * @method User getFrom()
 * @method Chat getSenderChat()
 * @method Int getDate()
 * @method Chat getChat()
 * @method string getFileId()
 * @method User getForwardFrom()
 * @method Chat getForwardFromChat()
 * @method Int getForwardFromMessageId()
 * @method string getForwardSignature()
 * @method string getForwardSenderName()
 * @method Int getForwardDate()
 * @method bool getIsAutomaticForward()
 * @method Message getReplyToMessage()
 * @method User getViaBot()
 * @method Int getEditDate()
 * @method bool getHasProtectedContent()
 * @method string getMediaGroupId()
 * @method Int getMessageId()
 * @method string getAuthorSignature()
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
 * @method bool getDeleteChatPhoto()
 * @method bool getGroupChatCreated()
 * @method bool getSupergroupChatCreated()
 * @method bool getChannelChatCreated()
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
 * @method bool isId()
 * @method bool isMessageId()
 * @method bool isFrom()
 * @method bool isSenderChat()
 * @method bool isDate()
 * @method bool isChat()
 * @method bool isFileId()
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
 * @method $this setId(int $value)
 * @method $this setMessageId(int $value)
 * @method $this setFrom(User $value)
 * @method $this setSenderChat(Chat $value)
 * @method $this setDate(int $value)
 * @method $this setChat(Chat $value)
 * @method $this setFileId(string $value)
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
 * @method $this unsetId()
 * @method $this unsetMessageId()
 * @method $this unsetFrom()
 * @method $this unsetSenderChat()
 * @method $this unsetDate()
 * @method $this unsetChat()
 * @method $this unsetFileId()
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
 * @property Int $id
 * @property Int $message_id
 * @property User $from
 * @property Chat $sender_chat
 * @property Int $date
 * @property Chat $chat
 * @property string $file_id
 * @property User $forward_from
 * @property Chat $forward_from_chat
 * @property Int $forward_from_message_id
 * @property string $forward_signature
 * @property string $forward_sender_name
 * @property Int $forward_date
 * @property bool $is_automatic_forward
 * @property Message $reply_to_message
 * @property User $via_bot
 * @property Int $edit_date
 * @property bool $has_protected_content
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
 * @property bool $delete_chat_photo
 * @property bool $group_chat_created
 * @property bool $supergroup_chat_created
 * @property bool $channel_chat_created
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
class Message extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'id' => 'int',
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
        'is_automatic_forward' => 'bool',
        'reply_to_message' => 'Message',
        'via_bot' => 'User',
        'edit_date' => 'int',
        'has_protected_content' => 'bool',
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
        'delete_chat_photo' => 'bool',
        'group_chat_created' => 'bool',
        'supergroup_chat_created' => 'bool',
        'channel_chat_created' => 'bool',
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
        'file_id' => 'string',
    ];

    private static array $downloadable_types = [
        'animation',
        'audio',
        'document',
        'photo',
        'sticker',
        'video',
        'video_note',
        'voice',
    ];

    /**
     * Initialize properties
     *
     * @return void
     */
    public function _init()
    {
        parent::_init();

        $this->_setProperty('id', $this->_getProperty('message_id'));

        $this->initializeFileId();
    }

    /**
     * Initialize FileId
     *
     * @return void
     */
    public function initializeFileId()
    {
        if ($type = collect(static::$downloadable_types)->first(fn($item) => $this->{$item})) {
            $update = is_array($this->{$type})
                ? end($this->{$type})
                : $this->{$type};

            $this->_setProperty('file_id', $update->file_id);
        }
    }

    /**
     * Copy current message to specified chat
     * @param $to
     * @param ...$args
     * @return Promise
     */
    public function copy($to = null, ... $args): Promise
    {
        $to ??= $this->chat->id;

        return $this->api->copyMessage(
            $args,
            chat_id: $to,
            from_chat_id: $this->chat->id,
            message_id: $this->message_id
        );
    }

    /**
     * Download current message media to file
     *
     * @param $dist
     * @return Promise
     */
    public function download($dist = null): Promise
    {
        return call(function () use ($dist) {
            if ($fileId = $this->file_id) {
                if ([$path, $link] = yield $this->api->getDownloadableLink($fileId)) {
                    $path = $dist ?? storage_path($path);
                    (yield isDirectory($dir = dirname($path))) || (yield createDirectoryRecursively($dir, 0755));

                    if ($file = yield openFile($path, 'c+')) {
                        $body = yield $this->api->get($link, stream: true);

                        while (null !== $chunk = yield $body->read(1024)) {
                            $file->write($chunk);
                        }

                        yield $file->close();

                        return $path;
                    }
                }
            }

            return false;
        });
    }

    /**
     * Delete current message
     *
     * @return Promise
     */
    public function delete(): Promise
    {
        return $this->api->deleteMessage(
            chat_id: $this->chat->id,
            message_id: $this->message_id,
        );
    }

    /**
     * Edit current message
     *
     * @param string $text
     * @param mixed ...$args
     * @return Promise
     */
    public function edit(string $text,mixed ...$args): Promise
    {
        $chatId = $this->chat->id;
        $messageId = $this->message_id;

        return $this->isText()
            ? $this->api->editMessageText(
                $args,
                chat_id: $chatId,
                message_id: $messageId,
                text: $text
            ) : $this->api->editMessageCaption(
                $args,
                chat_id: $chatId,
                message_id: $messageId,
                caption: $text
            );
    }

    /**
     * Replying text on current message
     *
     * @param string $text
     * @param mixed $args
     * @return Promise
     */
    public function reply(string $text,mixed ...$args): Promise
    {
        return $this->api->sendMessage(
            $args,
            chat_id: $this->chat->id,
            text: $text,
            parse_mode: 'html',
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying sticker on current message
     *
     * @param string $sticker
     * @param array $args
     * @return Promise
     */
    public function reply_sticker(string $sticker, ...$args): Promise
    {
        return $this->api->sendSticker(
            $args,
            chat_id: $this->chat->id,
            sticker: $sticker,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying video on current message
     *
     * @param string $video
     * @param array $args
     * @return Promise
     */
    public function reply_video(string $video, ...$args): Promise
    {
        return $this->api->sendVideo(
            $args,
            chat_id: $this->chat->id,
            video: $video,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying voice on current message
     *
     * @param string $voice
     * @param array $args
     * @return Promise
     */
    public function reply_voice(string $voice, ...$args): Promise
    {
        return $this->api->sendVoice(
            $args,
            chat_id: $this->chat->id,
            voice: $voice,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying animation on current message
     *
     * @param string $animation
     * @param array $args
     * @return Promise
     */
    public function reply_animation(string $animation, ...$args): Promise
    {
        return $this->api->sendAnimation(
            $args,
            chat_id: $this->chat->id,
            animation: $animation,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying photo on current message
     *
     * @param string $photo
     * @param array $args
     * @return Promise
     */
    public function reply_photo(string $photo, ...$args): Promise
    {
        return $this->api->sendPhoto(
            $args,
            chat_id: $this->chat->id,
            photo: $photo,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying dice on current message
     *
     * @param string $emoji
     * @param array $args
     * @return Promise
     */
    public function reply_dice(string $emoji, ...$args): Promise
    {
        return $this->api->sendDice(
            $args,
            chat_id: $this->chat->id,
            emoji: $emoji,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying document on current message
     *
     * @param string $document
     * @param array $args
     * @return Promise
     */
    public function reply_document(string $document, ...$args): Promise
    {
        return $this->api->sendDocument(
            $args,
            chat_id: $this->chat->id,
            document: $document,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying poll on current message
     *
     * @param string $question
     * @param array $options
     * @param array $args
     * @return Promise
     */
    public function reply_poll(string $question, array $options, array ...$args): Promise
    {
        return $this->api->sendPoll(
            $args,
            chat_id: $this->chat->id,
            question: $question,
            options: json_encode($options),
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying contact on current message
     *
     * @param string $phone_number
     * @param string $first_name
     * @param array $args
     * @return Promise
     */
    public function reply_contact(string $phone_number, string $first_name, ...$args): Promise
    {
        return $this->api->sendContact(
            $args,
            chat_id: $this->chat->id,
            phone_number: $phone_number,
            first_name: $first_name,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying location on current message
     *
     * @param float $latitude
     * @param float $longitude
     * @param array $args
     * @return Promise
     */
    public function reply_location(float $latitude, float $longitude, ...$args): Promise
    {
        return $this->api->sendLocation(
            $args,
            chat_id: $this->chat->id,
            latitude: $latitude,
            longitude: $longitude,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying media_group on current message
     *
     * @param array $media
     * @param array $args
     * @return Promise
     */
    public function reply_media_group(array $media, ...$args): Promise
    {
        return $this->api->sendMediaGroup(
            $args,
            chat_id: $this->chat->id,
            media: json_encode($media),
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying venue on current message
     *
     * @param float $latitude
     * @param float $longitude
     * @param array $args
     * @param string $title
     * @param string $address
     * @return Promise
     */
    public function reply_venue(
        float $latitude,
        float $longitude,
        string $title,
        string $address,
        ...$args
    ): Promise
    {
        return $this->api->sendVenue(
            $args,
            chat_id: $this->chat->id,
            latitude: $latitude,
            longitude:$longitude,
            title:$title,
            address:$address,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying audio on current message
     *
     * @param string $audio
     * @param array $args
     * @return Promise
     */
    public function reply_audio(string $audio, ...$args): Promise
    {
        return $this->api->sendAudio(
            $args,
            chat_id: $this->chat->id,
            audio: $audio,
            reply_to_message_id: $this->message_id,
        );
    }

    /**
     * Replying video_note on current message
     *
     * @param mixed $video_note
     * @param array ...$args
     * @return Promise
     */
    public function reply_video_note(string $video_note, ...$args): Promise
    {
        return $this->api->sendVideoNote(
            $args,
            chat_id: $this->chat->id,
            video_note: $video_note,
            reply_to_message_id: $this->message_id,
        );
    }
}