<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * Game
 *
 * @method string getTitle()
 * @method string getDescription()
 * @method PhotoSize[] getPhoto()
 * @method string getText()
 * @method MessageEntity[] getTextEntities()
 * @method Animation getAnimation()
 *
 * @method bool isTitle()
 * @method bool isDescription()
 * @method bool isPhoto()
 * @method bool isText()
 * @method bool isTextEntities()
 * @method bool isAnimation()
 *
 * @method $this setTitle(string $value)
 * @method $this setDescription(string $value)
 * @method $this setPhoto(PhotoSize[] $value)
 * @method $this setText(string $value)
 * @method $this setTextEntities(MessageEntity[] $value)
 * @method $this setAnimation(Animation $value)
 *
 * @method $this unsetTitle()
 * @method $this unsetDescription()
 * @method $this unsetPhoto()
 * @method $this unsetText()
 * @method $this unsetTextEntities()
 * @method $this unsetAnimation()
 *
 * @property string $title
 * @property string $description
 * @property PhotoSize[] $photo
 * @property string $text
 * @property MessageEntity[] $text_entities
 * @property Animation $animation
 */
class Game extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'title' => 'string',
        'description' => 'string',
        'photo' => 'PhotoSize[]',
        'text' => 'string',
        'text_entities' => 'MessageEntity[]',
        'animation' => 'Animation',
    ];
}