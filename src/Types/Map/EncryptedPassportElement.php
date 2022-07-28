<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * EncryptedPassportElement
 *
 * @method string getType()
 * @method string getData()
 * @method string getPhoneNumber()
 * @method string getEmail()
 * @method PassportFile[] getFiles()
 * @method PassportFile getFrontSide()
 * @method PassportFile getReverseSide()
 * @method PassportFile getSelfie()
 * @method PassportFile[] getTranslation()
 * @method string getHash()
 *
 * @method bool isType()
 * @method bool isData()
 * @method bool isPhoneNumber()
 * @method bool isEmail()
 * @method bool isFiles()
 * @method bool isFrontSide()
 * @method bool isReverseSide()
 * @method bool isSelfie()
 * @method bool isTranslation()
 * @method bool isHash()
 *
 * @method $this setType(string $value)
 * @method $this setData(string $value)
 * @method $this setPhoneNumber(string $value)
 * @method $this setEmail(string $value)
 * @method $this setFiles(PassportFile[] $value)
 * @method $this setFrontSide(PassportFile $value)
 * @method $this setReverseSide(PassportFile $value)
 * @method $this setSelfie(PassportFile $value)
 * @method $this setTranslation(PassportFile[] $value)
 * @method $this setHash(string $value)
 *
 * @method $this unsetType()
 * @method $this unsetData()
 * @method $this unsetPhoneNumber()
 * @method $this unsetEmail()
 * @method $this unsetFiles()
 * @method $this unsetFrontSide()
 * @method $this unsetReverseSide()
 * @method $this unsetSelfie()
 * @method $this unsetTranslation()
 * @method $this unsetHash()
 *
 * @property string $type
 * @property string $data
 * @property string $phone_number
 * @property string $email
 * @property PassportFile[] $files
 * @property PassportFile $front_side
 * @property PassportFile $reverse_side
 * @property PassportFile $selfie
 * @property PassportFile[] $translation
 * @property string $hash
 */
class EncryptedPassportElement extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'type' => 'string',
        'data' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'files' => 'PassportFile[]',
        'front_side' => 'PassportFile',
        'reverse_side' => 'PassportFile',
        'selfie' => 'PassportFile',
        'translation' => 'PassportFile[]',
        'hash' => 'string',
    ];
}