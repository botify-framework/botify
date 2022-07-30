<?php

namespace Botify\Methods\Webhooks;

use Amp\Promise;
use Botify\Types\Map\WebhookInfo;
use function Amp\call;
use function Botify\config;

trait ResetWebhook
{

    /**
     * Reset current webhook with additional params
     *
     * @param ...$args
     * @return Promise
     */
    protected function resetWebhook(...$args): Promise
    {
        return call(function () use ($args) {
            /**
             * @var $webhookInfo WebhookInfo
             */
            $webhookInfo = yield $this->getWebhookInfo();

            if ($webhookInfo->isSuccess()) {

                return yield $this->setWebhook(array_merge([
                    'url' => $webhookInfo->url,
                    'ip_address' => $webhookInfo->ip_address,
                    'max_connections' => $webhookInfo->max_connections,
                    'allowed_updates' => json_encode($webhookInfo->allowed_updates ?? []),
                    'secret_token' => config('telegram.secret_token')
                ], $args));
            }
            return $webhookInfo;
        });
    }
}