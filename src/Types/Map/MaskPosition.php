<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * MaskPosition
 *
 * @method string getPoint()
 * @method Float getXShift()
 * @method Float getYShift()
 * @method Float getScale()
 *
 * @method bool isPoint()
 * @method bool isXShift()
 * @method bool isYShift()
 * @method bool isScale()
 *
 * @method $this setPoint(string $value)
 * @method $this setXShift(float $value)
 * @method $this setYShift(float $value)
 * @method $this setScale(float $value)
 *
 * @method $this unsetPoint()
 * @method $this unsetXShift()
 * @method $this unsetYShift()
 * @method $this unsetScale()
 *
 * @property string $point
 * @property Float $x_shift
 * @property Float $y_shift
 * @property Float $scale
 */
class MaskPosition extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'point' => 'string',
        'x_shift' => 'float',
        'y_shift' => 'float',
        'scale' => 'float',
    ];
}