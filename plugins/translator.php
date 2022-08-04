<?php

use Botify\Types\Map\Message;
use Botify\Utils\Plugins\Pluggable;
use function Botify\value;

$filters = [
    function (Message $message) {
        if ($message->command(['tr', 'trans', 'translate'])) {
            $query = value(function () use ($message) {
                if (isset($message['reply_to_message'])) {
                    $replied = $message['reply_to_message'];
                    $q = $replied['caption'] ?? $replied['text'];
                    [$sl, $tl] = array_pad(explode(' ', $message['matches'][1], 2), -2, null);
                    return compact('sl', 'tl', 'q');
                }

                [$sl, $tl, $q] = array_pad(explode(' ', $message['matches'][1], 3), -3, null);
                return compact('sl', 'tl', 'q');
            });

            $symbols = ['ab', 'aa', 'af', 'ak', 'sq', 'am', 'ar', 'an', 'hy', 'as', 'av', 'ae', 'ay', 'az', 'bm', 'ba', 'eu', 'be', 'bn', 'bh', 'bi', 'bs', 'br', 'bg', 'my', 'ca', 'ch', 'ce', 'ny', 'zh', 'cv', 'kw', 'co', 'cr', 'hr', 'cs', 'da', 'dv', 'nl', 'en', 'eo', 'et', 'ee', 'fo', 'fj', 'fi', 'fr', 'ff', 'gl', 'ka', 'de', 'el', 'gn', 'gu', 'ht', 'ha', 'he', 'hz', 'hi', 'ho', 'hu', 'ia', 'id', 'ie', 'ga', 'ig', 'ik', 'io', 'is', 'it', 'iu', 'ja', 'jv', 'kl', 'kn', 'kr', 'ks', 'kk', 'km', 'ki', 'rw', 'ky', 'kv', 'kg', 'ko', 'ku', 'kj', 'la', 'lb', 'lg', 'li', 'ln', 'lo', 'lt', 'lu', 'lv', 'gv', 'mk', 'mg', 'ms', 'ml', 'mt', 'mi', 'mr', 'mh', 'mn', 'na', 'nv', 'nb', 'nd', 'ne', 'ng', 'nn', 'no', 'ii', 'nr', 'oc', 'oj', 'cu', 'om', 'or', 'os', 'pa', 'pi', 'fa', 'pl', 'ps', 'pt', 'qu', 'rm', 'rn', 'ro', 'ru', 'sa', 'sc', 'sd', 'se', 'sm', 'sg', 'sr', 'gd', 'sn', 'si', 'sk', 'sl', 'so', 'st', 'es', 'su', 'sw', 'ss', 'sv', 'ta', 'te', 'tg', 'th', 'ti', 'bo', 'tk', 'tl', 'tn', 'to', 'tr', 'ts', 'tt', 'tw', 'ty', 'ug', 'uk', 'ur', 'uz', 've', 'vi', 'vo', 'wa', 'cy', 'wo', 'fy', 'xh', 'yi', 'yo', 'za',];

            if (!in_array($query['tl'], $symbols)) {
                $query['q'] = $query['tl'] . ' ' . $query['q'];
                $query['tl'] = $query['sl'];
                $query['sl'] = 'auto';
            }
            if (!isset($query['tl'])) {
                $query['tl'] = 'fa';
            }
            if (!isset($query['sl']) || !in_array($query['sl'], $symbols)) {
                $query['sl'] = 'auto';
            }
            if ($query['q'] = trim($query['q'])) {
                return $this->body = $query;
            }
        }
    },
];


return new class($filters) extends Pluggable {
    private $url = 'https://translate.googleapis.com/translate_a/single';

    public function handle(Message $message)
    {
        $body = $this->body;
        $body['client'] = 'gtx';
        $body['dt'] = 't';
        $request = yield $this->getClient()->post($this->url, $body);

        if (($data = yield $request->json()) && isset($data[0])) {
            if ($sentence = implode(array_column($data[0], 0))) {
                yield $message->reply($sentence);
            }
        }

    }
};