<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineQueryResultGame
 *
 * @method string getType()
 * @method string getId()
 * @method string getGameShortName()
 * @method InlineKeyboardMarkup getReplyMarkup()
 *
 * @method bool isType()
 * @method bool isId()
 * @method bool isGameShortName()
 * @method bool isReplyMarkup()
 *
 * @method $this setType(string $value)
 * @method $this setId(string $value)
 * @method $this setGameShortName(string $value)
 * @method $this setReplyMarkup(InlineKeyboardMarkup $value)
 *
 * @method $this unsetType()
 * @method $this unsetId()
 * @method $this unsetGameShortName()
 * @method $this unsetReplyMarkup()
 *
 * @property string $type
 * @property string $id
 * @property string $game_short_name
 * @property InlineKeyboardMarkup $reply_markup
 */
class InlineQueryResultGame extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'id' => 'string',
        'game_short_name' => 'string',
        'reply_markup' => 'InlineKeyboardMarkup',
    ];
}