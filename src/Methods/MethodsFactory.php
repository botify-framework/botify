<?php

namespace Botify\Methods;

use Amp\Promise;
use Amp\Redis\Redis;
use Botify\Request\Client;
use Botify\TelegramAPI;
use Botify\Types\Map;
use Botify\Utils\Button;
use Botify\Utils\FallbackResponse;
use Botify\Utils\Logger\Logger;
use Exception;
use Medoo\DatabaseConnection;
use function Amp\call;

final class MethodsFactory
{
    use Methods;

    private static array $meable_attributes = [
        'user_id', 'chat_id',
    ];
    private Client $client;
    private ?DatabaseConnection $database;
    private ?Redis $redis;
    private Logger $logger;
    private array $responses_map = [
        Map\WebhookInfo::class => [
            'getWebhookInfo'
        ],
        Map\User::class => [
            'getMe'
        ],
        Map\Message::class => [
            'sendMessage',
            'forwardMessage',
            'sendPhoto',
            'sendAudio',
            'sendDocument',
            'sendVideo',
            'sendAnimation',
            'sendVoice',
            'sendVideoNote',
            'sendLocation',
            'editMessageLiveLocation',
            'stopMessageLiveLocation',
            'sendVenue',
            'sendContact',
            'sendPoll',
            'sendDice',
            'editMessageText',
            'editMessageCaption',
            'editMessageMedia',
            'editMessageReplyMarkup',
            'sendSticker',
            'sendInvoice',
            'sendGame',
            'setGameScore',
        ],
        Map\MessageId::class => [
            'copyMessage'
        ],
        Map\UserProfilePhotos::class => [
            'getUserProfilePhotos',
        ],
        Map\File::class => [
            'getFile',
            'uploadStickerFile',
            'createNewStickerSet',
            'addStickerToSet',
        ],
        Map\ChatInviteLink::class => [
            'createChatInviteLink',
            'editChatInviteLink',
            'revokeChatInviteLink',
        ],
        Map\Chat::class => [
            'getChat',
        ],
        Map\ChatMember::class => [
            'getChatMember',
        ],
        Map\MenuButtonCommands::class => [
            'getChatMenuButton',
        ],
        Map\MenuButton::class => [
            'getChatMenuButton',
        ],
        Map\Poll::class => [
            'stopPoll',
        ],
        Map\StickerSet::class => [
            'getStickerSet',
        ],
        Map\SentWebAppMessage::class => [
            'answerWebAppQuery',
        ]
    ];

    public function __construct(TelegramAPI $api)
    {
        $this->client = $api->getClient();
        $this->redis = $api->getRedis();
        $this->database = $api->getDatabase();
        $this->logger = $api->getLogger();
    }

    /**
     * Dynamic proxy Telegram methods
     *
     * @param string $name
     * @param array $arguments
     * @return Promise
     * @throws Exception
     */
    public function __call(string $name, array $arguments = [])
    {
        static $mapped = [];

        if (empty($mapped))
            foreach ($this->responses_map as $response => $methods)
                foreach ($methods as $method)
                    $mapped[strtolower($method)] = $response;

        $arguments = isset($arguments[0]) && is_array($arguments[0])
            ? value(function () use ($arguments) {
                $arguments = array_merge(array_shift($arguments), $arguments);

                return array_some($arguments, fn($v, $k) => is_string($k))
                    ? $arguments
                    : [$arguments];
            })
            : $arguments;

        $this->bindAttributes($arguments);

        if (method_exists($this, $name)) {
            return $this->{$name}(... $arguments);
        }

        $arguments = [$arguments];

        /**
         * Prepend method name to arguments
         */
        array_unshift($arguments, $name);

        $cast = $mapped[strtolower($name)] ?? false;

        return call(function () use ($arguments, $cast) {
            $response = yield $this->client->post(... $arguments);

            if ($response['ok']) {
                if (in_array(gettype($response['result']), ['boolean', 'integer', 'string'])) {
                    return $response['result'];
                }

                return new $cast($response['result']);
            }

            return new FallbackResponse($response);
        });
    }

    /**
     * Bind attributes before passing to request
     *
     * @param $attributes
     * @return void
     */
    private function bindAttributes(&$attributes)
    {
        if (isset($attributes['text'])) {
            $text = &$attributes['text'];

            if (is_array($text)) {
                $text = print_r($text, true);
            } elseif (is_object($text)) {
                if (method_exists($text, '__toString')) {
                    $text = (string)$text;
                } else {
                    $text = var_export($text, true);
                }
            }
        }

        if (isset($attributes['reply_markup'])) {
            $replyMarkup = &$attributes['reply_markup'];

            if (is_array($replyMarkup)) {
                $replyMarkup = Button::make($replyMarkup);
            }
        }

        foreach (self::$meable_attributes as $attr)
            if (isset($attributes[$attr]) && is_string($attribute = &$attributes[$attr]) && $attribute === 'me')
                $attribute = config('telegram.user_id');
    }
}