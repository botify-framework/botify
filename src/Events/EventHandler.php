<?php

namespace Botify\Events;

use Amp\Promise;
use Amp\Redis\Redis;
use ArrayAccess;
use Botify\TelegramAPI;
use Botify\Traits\HasBag;
use Botify\Types\Map\CallbackQuery;
use Botify\Types\Map\ChatJoinRequest;
use Botify\Types\Map\ChatMemberUpdated;
use Botify\Types\Map\ChosenInlineResult;
use Botify\Types\Map\InlineQuery;
use Botify\Types\Map\Message;
use Botify\Types\Map\PreCheckoutQuery;
use Botify\Types\Map\ShippingQuery;
use Botify\Types\Update;
use Botify\Utils\DataBag;
use Psr\Log\LoggerInterface;
use Throwable;
use function Amp\call;
use function Botify\gather;

class EventHandler implements ArrayAccess
{
    use HasBag;

    public ?TelegramAPI $api = null;
    public $current;
    public LoggerInterface $logger;
    public ?Redis $redis = null;
    private DataBag $bag;
    private ?Update $update = null;

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

        return $this->api->{$name}(... $arguments) ?? trigger_error(sprintf(
                'Trying to call undefined method [%s]', $name
            ), E_USER_ERROR);
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

            yield call([$this, 'onStart']);

            $promises = [call([$this, 'onAny'], $this->update)];

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

    public function getBag(): array
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
     * Set TelegramAPI instance
     *
     * @param Update $update
     * @param DataBag $bag
     * @return EventHandler
     */
    final public function register(Update $update, DataBag $bag): EventHandler
    {
        $this->update = $update;
        $this->api = $update->getAPI();
        $this->redis = $this->api->getRedis();
        $this->logger = $this->api->getLogger();
        $this->bag = $bag;
        return $this;
    }
}