<?php

namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * KeyboardButton
 *
 * @method string getText()
 * @method Bool getRequestContact()
 * @method Bool getRequestLocation()
 * @method KeyboardButtonPollType getRequestPoll()
 * @method WebAppInfo getWebApp()
 *
 * @method bool isText()
 * @method bool isRequestContact()
 * @method bool isRequestLocation()
 * @method bool isRequestPoll()
 * @method bool isWebApp()
 *
 * @method $this setText(string $value)
 * @method $this setRequestContact(bool $value)
 * @method $this setRequestLocation(bool $value)
 * @method $this setRequestPoll(KeyboardButtonPollType $value)
 * @method $this setWebApp(WebAppInfo $value)
 *
 * @method $this unsetText()
 * @method $this unsetRequestContact()
 * @method $this unsetRequestLocation()
 * @method $this unsetRequestPoll()
 * @method $this unsetWebApp()
 *
 * @property string $text
 * @property Bool $request_contact
 * @property Bool $request_location
 * @property KeyboardButtonPollType $request_poll
 * @property WebAppInfo $web_app
 */
class KeyboardButton extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'text' => 'string',
        'request_contact' => 'Bool',
        'request_location' => 'Bool',
        'request_poll' => 'KeyboardButtonPollType',
        'web_app' => 'WebAppInfo',
    ];
}