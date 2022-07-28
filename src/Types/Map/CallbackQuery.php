<?php

namespace Botify\Types\Map;

use Amp\Promise;
use Botify\Traits\Stringable;
use Botify\Utils\LazyJsonMapper;

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

    use Stringable;

    const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'from' => 'User',
        'message' => 'Message',
        'inline_message_id' => 'string',
        'chat_instance' => 'string',
        'data' => 'string',
        'game_short_name' => 'string',
    ];

    /**
     * Answer on current callback
     *
     * @param $text
     * @param bool $showAlert
     * @param ...$args
     * @return Promise
     */
    public function answer($text, bool $showAlert = true, ...$args): Promise
    {
        return $this->getAPI()->answerCallbackQuery(
            $args,
            callback_query_id: $this->id,
            text: $text,
            show_alert: $showAlert,
        );
    }

    protected function getStringableValue(): ?string
    {
        return $this->data;
    }
}