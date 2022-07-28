<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * LoginUrl
 *
 * @method string getUrl()
 * @method string getForwardText()
 * @method string getBotUsername()
 * @method bool getRequestWriteAccess()
 *
 * @method bool isUrl()
 * @method bool isForwardText()
 * @method bool isBotUsername()
 * @method bool isRequestWriteAccess()
 *
 * @method $this setUrl(string $value)
 * @method $this setForwardText(string $value)
 * @method $this setBotUsername(string $value)
 * @method $this setRequestWriteAccess(bool $value)
 *
 * @method $this unsetUrl()
 * @method $this unsetForwardText()
 * @method $this unsetBotUsername()
 * @method $this unsetRequestWriteAccess()
 *
 * @property string $url
 * @property string $forward_text
 * @property string $bot_username
 * @property bool $request_write_access
 */
class LoginUrl extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'url' => 'string',
        'forward_text' => 'string',
        'bot_username' => 'string',
        'request_write_access' => 'bool',
    ];
}