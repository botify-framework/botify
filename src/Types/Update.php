<?php

namespace Jove\Types;

use LazyJsonMapper\LazyJsonMapper;

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