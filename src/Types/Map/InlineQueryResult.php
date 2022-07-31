<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

class InlineQueryResult extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        InlineQueryResultCachedAudio::class,
        InlineQueryResultCachedDocument::class,
        InlineQueryResultCachedGif::class,
        InlineQueryResultCachedMpeg4Gif::class,
        InlineQueryResultCachedPhoto::class,
        InlineQueryResultCachedSticker::class,
        InlineQueryResultCachedVideo::class,
        InlineQueryResultCachedVoice::class,
        InlineQueryResultArticle::class,
        InlineQueryResultAudio::class,
        InlineQueryResultContact::class,
        InlineQueryResultGame::class,
        InlineQueryResultDocument::class,
        InlineQueryResultGif::class,
        InlineQueryResultLocation::class,
        InlineQueryResultMpeg4Gif::class,
        InlineQueryResultPhoto::class,
        InlineQueryResultVenue::class,
        InlineQueryResultVideo::class,
        InlineQueryResultVoice::class,
    ];
}