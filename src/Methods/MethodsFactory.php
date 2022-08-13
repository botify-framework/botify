<?php

namespace Botify\Methods;

use Amp\Promise;
use Amp\Redis\Redis;
use Botify\Exceptions\RetryException;
use Botify\Request\Client;
use Botify\TelegramAPI;
use Botify\Types\Map;
use Botify\Utils\Button;
use Botify\Utils\FallbackResponse;
use Botify\Utils\Logger\Logger;
use Exception;
use function Amp\call;
use function Botify\array_some;
use function Botify\config;
use function Botify\retry;
use function Botify\value;

/**
 * @mixin MethodsDoc
 */
final class MethodsFactory
{
    use Methods;

    private static array $meable_attributes = [
        'user_id', 'chat_id',
    ];
    protected Client $client;
    protected Logger $logger;
    protected ?Redis $redis;
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

    public function __construct(public TelegramAPI $api)
    {
        $this->client = $api->getClient();
        $this->redis = $api->getRedis();
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

        return call(function () use ($name, $arguments, $cast) {
            return yield retry($times = config('telegram.sleep_threshold', 1), function ($attempts) use ($name, $times, $cast, $arguments) {
                $request = yield $this->client->post(... $arguments);
                $response = yield $request->json();

                if (empty($response['ok'])) {
                    if (isset($response['error_code'])) {
                        switch ($response['error_code']) {
                            case 429:
                                if ($attempts > $times) {
                                    throw new RetryException($response['parameters']['retry_after'], $response['description']);
                                }
                                break;
                            case 404:
                                throw new Exception(sprintf(
                                    'Trying to call undefined method [%s]', $name
                                ));
                            case 401:
                                throw new Exception('You must provide a valid token');
                        }

                    }
                } else {
                    if (in_array(gettype($response['result']), ['boolean', 'integer', 'string'])) {
                        return $response['result'];
                    }

                    return new $cast($response['result']);
                }

                return new FallbackResponse($response);
            }, function ($attempts, $exception) use ($name) {
                $retryAfter = $exception->getRetryAfter();
                $this->logger->notice(sprintf('[%d] Waiting for %d seconds before continuing (required by "%s")', config('telegram.bot_user_id'), $retryAfter, $name));
                return $retryAfter;
            });
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
                $attribute = config('telegram.bot_user_id');
    }
}