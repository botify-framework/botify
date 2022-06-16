<?php

namespace Jove\Types;

use LazyJsonMapper\LazyJsonMapper;

class Update extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'update_id'             => 'int',
        'message'               => 'Message',
        'edited_message'        => 'Message',
        'channel_post'          => 'Message',
        'edited_channel_post'   => 'Message',
        'inline_query'          => 'InlineQuery',
        'chosen_inline_result'  => 'ChosenInlineResult',
        'callback_query'        => 'CallbackQuery',
        'shipping_query'        => 'ShippingQuery',
        'pre_checkout_query'    => 'PreCheckoutQuery',
        'poll'                  => 'Poll',
        'poll_answer'           => 'PollAnswer',
        'my_chat_member'        => 'MyChatMember',
        ''
    ];
}