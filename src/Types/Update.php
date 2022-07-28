<?php

namespace Botify\Types;

use Botify\Utils\LazyJsonMapper;

/**
 * Update
 *
 * @method Int getUpdateId()
 * @method Map\Message getMessage()
 * @method Map\Message getEditedMessage()
 * @method Map\Message getChannelPost()
 * @method Map\Message getEditedChannelPost()
 * @method Map\InlineQuery getInlineQuery()
 * @method Map\ChosenInlineResult getChosenInlineResult()
 * @method Map\CallbackQuery getCallbackQuery()
 * @method Map\ShippingQuery getShippingQuery()
 * @method Map\PreCheckoutQuery getPreCheckoutQuery()
 * @method Map\Poll getPoll()
 * @method Map\PollAnswer getPollAnswer()
 * @method Map\ChatMemberUpdated getMyChatMember()
 * @method Map\ChatMemberUpdated getChatMember()
 * @method Map\ChatJoinRequest getChatJoinRequest()
 *
 * @method bool isUpdateId()
 * @method bool isMessage()
 * @method bool isEditedMessage()
 * @method bool isChannelPost()
 * @method bool isEditedChannelPost()
 * @method bool isInlineQuery()
 * @method bool isChosenInlineResult()
 * @method bool isCallbackQuery()
 * @method bool isShippingQuery()
 * @method bool isPreCheckoutQuery()
 * @method bool isPoll()
 * @method bool isPollAnswer()
 * @method bool isMyChatMember()
 * @method bool isChatMember()
 * @method bool isChatJoinRequest()
 *
 * @method $this setUpdateId(int $value)
 * @method $this setMessage(Map\Message $value)
 * @method $this setEditedMessage(Map\Message $value)
 * @method $this setChannelPost(Map\Message $value)
 * @method $this setEditedChannelPost(Map\Message $value)
 * @method $this setInlineQuery(Map\InlineQuery $value)
 * @method $this setChosenInlineResult(Map\ChosenInlineResult $value)
 * @method $this setCallbackQuery(Map\CallbackQuery $value)
 * @method $this setShippingQuery(Map\ShippingQuery $value)
 * @method $this setPreCheckoutQuery(Map\PreCheckoutQuery $value)
 * @method $this setPoll(Map\Poll $value)
 * @method $this setPollAnswer(Map\PollAnswer $value)
 * @method $this setMyChatMember(Map\ChatMemberUpdated $value)
 * @method $this setChatMember(Map\ChatMemberUpdated $value)
 * @method $this setChatJoinRequest(Map\ChatJoinRequest $value)
 *
 * @method $this unsetUpdateId()
 * @method $this unsetMessage()
 * @method $this unsetEditedMessage()
 * @method $this unsetChannelPost()
 * @method $this unsetEditedChannelPost()
 * @method $this unsetInlineQuery()
 * @method $this unsetChosenInlineResult()
 * @method $this unsetCallbackQuery()
 * @method $this unsetShippingQuery()
 * @method $this unsetPreCheckoutQuery()
 * @method $this unsetPoll()
 * @method $this unsetPollAnswer()
 * @method $this unsetMyChatMember()
 * @method $this unsetChatMember()
 * @method $this unsetChatJoinRequest()
 *
 * @property Int $update_id
 * @property Map\Message $message
 * @property Map\Message $edited_message
 * @property Map\Message $channel_post
 * @property Map\Message $edited_channel_post
 * @property Map\InlineQuery $inline_query
 * @property Map\ChosenInlineResult $chosen_inline_result
 * @property Map\CallbackQuery $callback_query
 * @property Map\ShippingQuery $shipping_query
 * @property Map\PreCheckoutQuery $pre_checkout_query
 * @property Map\Poll $poll
 * @property Map\PollAnswer $poll_answer
 * @property Map\ChatMemberUpdated $my_chat_member
 * @property Map\ChatMemberUpdated $chat_member
 * @property Map\ChatJoinRequest $chat_join_request
 */
class Update extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'update_id' => 'int',
        'message' => 'Map\Message',
        'edited_message' => 'Map\Message',
        'channel_post' => 'Map\Message',
        'edited_channel_post' => 'Map\Message',
        'inline_query' => 'Map\InlineQuery',
        'chosen_inline_result' => 'Map\ChosenInlineResult',
        'callback_query' => 'Map\CallbackQuery',
        'shipping_query' => 'Map\ShippingQuery',
        'pre_checkout_query' => 'Map\PreCheckoutQuery',
        'poll' => 'Map\Poll',
        'poll_answer' => 'Map\PollAnswer',
        'my_chat_member' => 'Map\ChatMemberUpdated',
        'chat_member' => 'Map\ChatMemberUpdated',
        'chat_join_request' => 'Map\ChatJoinRequest',
    ];
}