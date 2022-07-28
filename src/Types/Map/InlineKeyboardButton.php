<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * InlineKeyboardButton
 *
 * @method string getText()
 * @method string getUrl()
 * @method string getCallbackData()
 * @method WebAppInfo getWebApp()
 * @method LoginUrl getLoginUrl()
 * @method string getSwitchInlineQuery()
 * @method string getSwitchInlineQueryCurrentChat()
 * @method CallbackGame getCallbackGame()
 * @method bool getPay()
 *
 * @method bool isText()
 * @method bool isUrl()
 * @method bool isCallbackData()
 * @method bool isWebApp()
 * @method bool isLoginUrl()
 * @method bool isSwitchInlineQuery()
 * @method bool isSwitchInlineQueryCurrentChat()
 * @method bool isCallbackGame()
 * @method bool isPay()
 *
 * @method $this setText(string $value)
 * @method $this setUrl(string $value)
 * @method $this setCallbackData(string $value)
 * @method $this setWebApp(WebAppInfo $value)
 * @method $this setLoginUrl(LoginUrl $value)
 * @method $this setSwitchInlineQuery(string $value)
 * @method $this setSwitchInlineQueryCurrentChat(string $value)
 * @method $this setCallbackGame(CallbackGame $value)
 * @method $this setPay(bool $value)
 *
 * @method $this unsetText()
 * @method $this unsetUrl()
 * @method $this unsetCallbackData()
 * @method $this unsetWebApp()
 * @method $this unsetLoginUrl()
 * @method $this unsetSwitchInlineQuery()
 * @method $this unsetSwitchInlineQueryCurrentChat()
 * @method $this unsetCallbackGame()
 * @method $this unsetPay()
 *
 * @property string $text
 * @property string $url
 * @property string $callback_data
 * @property WebAppInfo $web_app
 * @property LoginUrl $login_url
 * @property string $switch_inline_query
 * @property string $switch_inline_query_current_chat
 * @property CallbackGame $callback_game
 * @property bool $pay
 */
class InlineKeyboardButton extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'text' => 'string',
        'url' => 'string',
        'callback_data' => 'string',
        'web_app' => 'WebAppInfo',
        'login_url' => 'LoginUrl',
        'switch_inline_query' => 'string',
        'switch_inline_query_current_chat' => 'string',
        'callback_game' => 'CallbackGame',
        'pay' => 'bool',
    ];
}