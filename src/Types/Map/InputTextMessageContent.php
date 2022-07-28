<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InputTextMessageContent
 *
 * @method string getMessageText()
 * @method ParseMode getParseMode()
 * @method MessageEntity[] getEntities()
 * @method bool getDisableWebPagePreview()
 *
 * @method bool isMessageText()
 * @method bool isParseMode()
 * @method bool isEntities()
 * @method bool isDisableWebPagePreview()
 *
 * @method $this setMessageText(string $value)
 * @method $this setParseMode(ParseMode $value)
 * @method $this setEntities(MessageEntity[] $value)
 * @method $this setDisableWebPagePreview(bool $value)
 *
 * @method $this unsetMessageText()
 * @method $this unsetParseMode()
 * @method $this unsetEntities()
 * @method $this unsetDisableWebPagePreview()
 *
 * @property string $message_text
 * @property ParseMode $parse_mode
 * @property MessageEntity[] $entities
 * @property bool $disable_web_page_preview
 */
class InputTextMessageContent extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'message_text' => 'string',
        'parse_mode' => 'ParseMode',
        'entities' => 'MessageEntity[]',
        'disable_web_page_preview' => 'bool',
    ];
}