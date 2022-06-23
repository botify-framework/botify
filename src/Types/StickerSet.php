<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * StickerSet
 *
 * @method string getName()
 * @method string getTitle()
 * @method Bool getIsAnimated()
 * @method Bool getIsVideo()
 * @method Bool getContainsMasks()
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
 * @property Bool $is_animated
 * @property Bool $is_video
 * @property Bool $contains_masks
 * @property Sticker[] $stickers
 * @property PhotoSize $thumb
 */

class StickerSet extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'name' => 'string',		'title' => 'string',		'is_animated' => 'Bool',		'is_video' => 'Bool',		'contains_masks' => 'Bool',		'stickers' => 'Sticker[]',		'thumb' => 'PhotoSize',	];
}