<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * StickerSet
 *
 * @method string getName()
 * @method string getTitle()
 * @method bool getIsAnimated()
 * @method bool getIsVideo()
 * @method bool getContainsMasks()
 * @method Sticker[] getStickers()
 * @method PhotoSize getThumb()
 *
 * @method bool isName()
 * @method bool isTitle()
 * @method bool isIsAnimated()
 * @method bool isIsVideo()
 * @method bool isContainsMasks()
 * @method bool isStickers()
 * @method bool isThumb()
 *
 * @method $this setName(string $value)
 * @method $this setTitle(string $value)
 * @method $this setIsAnimated(bool $value)
 * @method $this setIsVideo(bool $value)
 * @method $this setContainsMasks(bool $value)
 * @method $this setStickers(Sticker[] $value)
 * @method $this setThumb(PhotoSize $value)
 *
 * @method $this unsetName()
 * @method $this unsetTitle()
 * @method $this unsetIsAnimated()
 * @method $this unsetIsVideo()
 * @method $this unsetContainsMasks()
 * @method $this unsetStickers()
 * @method $this unsetThumb()
 *
 * @property string $name
 * @property string $title
 * @property bool $is_animated
 * @property bool $is_video
 * @property bool $contains_masks
 * @property Sticker[] $stickers
 * @property PhotoSize $thumb
 */
class StickerSet extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'name' => 'string',
        'title' => 'string',
        'is_animated' => 'bool',
        'is_video' => 'bool',
        'contains_masks' => 'bool',
        'stickers' => 'Sticker[]',
        'thumb' => 'PhotoSize',
    ];
}