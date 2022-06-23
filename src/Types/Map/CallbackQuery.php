<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * CallbackQuery
 *
 * @method string getId()
 * @method User getFrom()
 * @method Message getMessage()
 * @method string getInlineMessageId()
 * @method string getChatInstance()
 * @method string getData()
 * @method string getGameShortName()
 *
 * @method bool isId()
 * @method bool isFrom()
 * @method bool isMessage()
 * @method bool isInlineMessageId()
 * @method bool isChatInstance()
 * @method bool isData()
 * @method bool isGameShortName()
 *
 * @method $this setId(string $value)
 * @method $this setFrom(User $value)
 * @method $this setMessage(Message $value)
 * @method $this setInlineMessageId(string $value)
 * @method $this setChatInstance(string $value)
 * @method $this setData(string $value)
 * @method $this setGameShortName(string $value)
 *
 * @method $this unsetId()
 * @method $this unsetFrom()
 * @method $this unsetMessage()
 * @method $this unsetInlineMessageId()
 * @method $this unsetChatInstance()
 * @method $this unsetData()
 * @method $this unsetGameShortName()
 *
 * @property string $id
 * @property User $from
 * @property Message $message
 * @property string $inline_message_id
 * @property string $chat_instance
 * @property string $data
 * @property string $game_short_name
 */
class CallbackQuery extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'from' => 'User',
        'message' => 'Message',
        'inline_message_id' => 'string',
        'chat_instance' => 'string',
        'data' => 'string',
        'game_short_name' => 'string',
    ];
}