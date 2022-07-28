<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * WebAppData
 *
 * @method string getData()
 * @method string getButtonText()
 *
 * @method bool isData()
 * @method bool isButtonText()
 *
 * @method $this setData(string $value)
 * @method $this setButtonText(string $value)
 *
 * @method $this unsetData()
 * @method $this unsetButtonText()
 *
 * @property string $data
 * @property string $button_text
 */
class WebAppData extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'data' => 'string',
        'button_text' => 'string',
    ];
}