<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * Update
 *
 * @method Int getUpdateId()
 * @method Message getMessage()
 * @method Message getEditedMessage()
 * @method Message getChannelPost()
 * @method Message getEditedChannelPost()
 * @method InlineQuery getInlineQuery()
 * @method ChosenInlineResult getChosenInlineResult()
 * @method CallbackQuery getCallbackQuery()
 * @method ShippingQuery getShippingQuery()
 * @method PreCheckoutQuery getPreCheckoutQuery()
 * @method Poll getPoll()
 * @method PollAnswer getPollAnswer()
 * @method ChatMemberUpdated getMyChatMember()
 * @method ChatMemberUpdated getChatMember()
 * @method ChatJoinRequest getChatJoinRequest()
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
 * @method $this setMessage(Message $value)
 * @method $this setEditedMessage(Message $value)
 * @method $this setChannelPost(Message $value)
 * @method $this setEditedChannelPost(Message $value)
 * @method $this setInlineQuery(InlineQuery $value)
 * @method $this setChosenInlineResult(ChosenInlineResult $value)
 * @method $this setCallbackQuery(CallbackQuery $value)
 * @method $this setShippingQuery(ShippingQuery $value)
 * @method $this setPreCheckoutQuery(PreCheckoutQuery $value)
 * @method $this setPoll(Poll $value)
 * @method $this setPollAnswer(PollAnswer $value)
 * @method $this setMyChatMember(ChatMemberUpdated $value)
 * @method $this setChatMember(ChatMemberUpdated $value)
 * @method $this setChatJoinRequest(ChatJoinRequest $value)
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
 * @property Message $message
 * @property Message $edited_message
 * @property Message $channel_post
 * @property Message $edited_channel_post
 * @property InlineQuery $inline_query
 * @property ChosenInlineResult $chosen_inline_result
 * @property CallbackQuery $callback_query
 * @property ShippingQuery $shipping_query
 * @property PreCheckoutQuery $pre_checkout_query
 * @property Poll $poll
 * @property PollAnswer $poll_answer
 * @property ChatMemberUpdated $my_chat_member
 * @property ChatMemberUpdated $chat_member
 * @property ChatJoinRequest $chat_join_request
 */

class Update extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'update_id' => 'int',		'message' => 'Message',		'edited_message' => 'Message',		'channel_post' => 'Message',		'edited_channel_post' => 'Message',		'inline_query' => 'InlineQuery',		'chosen_inline_result' => 'ChosenInlineResult',		'callback_query' => 'CallbackQuery',		'shipping_query' => 'ShippingQuery',		'pre_checkout_query' => 'PreCheckoutQuery',		'poll' => 'Poll',		'poll_answer' => 'PollAnswer',		'my_chat_member' => 'ChatMemberUpdated',		'chat_member' => 'ChatMemberUpdated',		'chat_join_request' => 'ChatJoinRequest',	];
}