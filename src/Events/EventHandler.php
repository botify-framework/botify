<?php

namespace Botify\Events;

use Amp\Promise;
use Amp\Redis\Redis;
use Amp\Success;
use ArrayAccess;
use Botify\TelegramAPI;
use Botify\Traits\Accessible;
use Botify\Types\Map\CallbackQuery;
use Botify\Types\Map\ChatJoinRequest;
use Botify\Types\Map\ChatMemberUpdated;
use Botify\Types\Map\ChosenInlineResult;
use Botify\Types\Map\InlineQuery;
use Botify\Types\Map\Message;
use Botify\Types\Map\PreCheckoutQuery;
use Botify\Types\Map\ShippingQuery;
use Botify\Types\Update;
use Botify\Utils\Bag;
use Psr\Log\LoggerInterface;
use Throwable;
use function Amp\call;
use function Botify\{array_first, array_some, config, gather, tap};

class EventHandler implements ArrayAccess
{
    use Accessible;

    protected ?TelegramAPI $api = null;
    public $current;
    protected LoggerInterface $logger;
    protected ?Redis $redis = null;
    protected Bag $bag;
    protected ?Update $update = null;
    public bool $started = false;

    /**
     * Dynamic method proxy for calling TelegramAPI methods
     *
     * @param $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments = [])
    {
        if (is_object($this->current) && method_exists($this->current, $name)) {
            return $this->current->{$name}(... $arguments);
        }

        return $this->api->{$name}(... $arguments);
    }

    /**
     * Bootstrap the event handler
     *
     * @return Promise
     */
    public function fire(): Promise
    {
        return call(function () {
            $events = [
                'message' => [[$this, 'onUpdateNewMessage']],
                'edited_message' => [[$this, 'onUpdateNewMessage'], [$this, 'onUpdateEditedMessage']],
                'channel_post' => [[$this, 'onUpdateNewChannelMessage']],
                'edited_channel_post' => [[$this, 'onUpdateNewChannelMessage'], [$this, 'onUpdateEditedChannelMessage']],
                'callback_query' => [[$this, 'onUpdateCallbackQuery']],
                'inline_query' => [[$this, 'onUpdateInlineQuery']],
                'chosen_inline_result' => [[$this, 'onUpdateChosenInlineResult']],
                'shipping_query' => [[$this, 'onUpdateShippingQuery']],
                'pre_checkout_query' => [[$this, 'onUpdatePreCheckoutQuery']],
                'poll' => [[$this, 'onUpdatePoll']],
                'poll_answer' => [[$this, 'onUpdatePollAnswer']],
                'my_chat_member' => [[$this, 'onUpdateMyChatMember']],
                'chat_member' => [[$this, 'onUpdateChatMember']],
                'chat_join_request' => [[$this, 'onUpdateChatJoinRequest']],
            ];

            $promises = [$this->handleMention([$this, 'onMention'])];

            foreach ($events as $event => $listeners) {
                foreach ($listeners as $listener) {
                    if (isset($this->update[$event])) {
                        $current = $this->update[$event];
                        $self = clone $listener[0];
                        $self->current = $current;
                        $listener[0] = $self;
                        $promises[] = call($listener, $current);
                    }
                }
            }

            try {
                yield gather($promises);
            } catch (Throwable $e) {
                $this->logger->critical($e);
            }
        });
    }

    public function handleMention(callable $callback): Promise|Success
    {
        if (isset($this->update['message'])) {
            /** @var Message $message */
            $message = $this->update['message'];
            if (isset($message['entities']) && array_some($message['entities'], function ($entity) {
                    return $entity['type'] === 'mention';
                })) {
                return call(function () use ($callback, $message) {
                    if (!$username = config('telegram.bot_username')) {
                        $user = yield $this->api->getMe();

                        if ($user->isSuccess()) {
                            config(['telegram.bot_username' => $username = $user['username']]);
                        }
                    }
                    $username = ltrim(preg_quote($username, '/'), '@');

                    if ($message->regex("/\B@{$username}\b/i")) {
                        return yield call($callback, $message);
                    }
                });
            } elseif (isset($message['entities']) && $entity = array_first($message['entities'], function ($entity) {
                    return $entity['type'] === 'text_mention' && $entity['user']['is_self'];
                })) {
                config('telegram.bot_username', fn() => config(['telegram.bot_username' => $entity['username']]));

                return call($callback, $message);
            } elseif (isset($message['reply_to_message']['from']) && $message['reply_to_message']['from']['is_self']) {
                config('telegram.bot_username', fn() => config(['telegram.bot_username' => $message['reply_to_message']['from']['username']]));

                return call($callback, $message);
            }
        }

        return new Success();
    }

    public function getAccessibles(): array
    {
        return [$this->api, $this->current, $this->bag];
    }

    /**
     * @param Update $update
     */
    public function onAny(Update $update)
    {
    }

    /**
     * This action called when eventHandler was started
     */
    public function onStart()
    {
    }

    /**
     * @param CallbackQuery $callbackQuery
     */
    public function onUpdateCallbackQuery(CallbackQuery $callbackQuery)
    {
    }

    /**
     * @param ChatJoinRequest $chatJoinRequest
     * @return void
     */
    public function onUpdateChatJoinRequest(ChatJoinRequest $chatJoinRequest)
    {

    }

    /**
     * @param ChatMemberUpdated $chatMemberUpdated
     */
    public function onUpdateChatMember(ChatMemberUpdated $chatMemberUpdated)
    {
    }

    /**
     * @param ChosenInlineResult $chosenInlineResult
     */
    public function onUpdateChosenInlineResult(ChosenInlineResult $chosenInlineResult)
    {
    }

    /**
     * @param Message $message
     */
    public function onUpdateEditedChannelMessage(Message $message)
    {
    }

    /**
     * @param Message $message
     */
    public function onUpdateEditedMessage(Message $message)
    {
    }

    /**
     * @param InlineQuery $inlineQuery
     */
    public function onUpdateInlineQuery(InlineQuery $inlineQuery)
    {
    }

    /**
     * @param ChatMemberUpdated $chatMemberUpdated
     */
    public function onUpdateMyChatMember(ChatMemberUpdated $chatMemberUpdated)
    {
    }

    /**
     * @param Message $message
     */
    public function onUpdateNewChannelMessage(Message $message)
    {
    }

    /**
     * @param Message $message
     */
    public function onUpdateNewMessage(Message $message)
    {
    }

    /**
     * @param PreCheckoutQuery $preCheckoutQuery
     */
    public function onUpdatePreCheckoutQuery(PreCheckoutQuery $preCheckoutQuery)
    {
    }

    /**
     * @param ShippingQuery $shippingQuery
     */
    public function onUpdateShippingQuery(ShippingQuery $shippingQuery)
    {
    }

    /**
     * @param Message $message
     */
    public function onMention(Message $message)
    {
    }

    /**
     * Set TelegramAPI instance
     *
     * @param Update $update
     * @param Bag $bag
     * @return EventHandler
     */
    final public function register(Update $update, Bag $bag): EventHandler
    {
        $this->update = $update;
        $this->api = $update->getAPI();
        $this->redis = $this->api->getRedis();
        $this->logger = $this->api->getLogger();
        $this->bag = $bag;
        return $this;
    }

    public function tapStarted(): bool
    {
        return tap($this->started, function () {
            $this->started = true;
        });
    }
}