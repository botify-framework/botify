<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

class PassportElementError extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        PassportElementErrorDataField::class,
        PassportElementErrorFrontSide::class,
        PassportElementErrorReverseSide::class,
        PassportElementErrorSelfie::class,
        PassportElementErrorFile::class,
        PassportElementErrorFiles::class,
        PassportElementErrorTranslationFile::class,
        PassportElementErrorTranslationFiles::class,
        PassportElementErrorUnspecified::class,
    ];
}