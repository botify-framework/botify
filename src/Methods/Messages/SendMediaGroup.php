<?php

namespace Botify\Methods\Messages;

use Amp\Promise;
use Botify\Types\Map\Message;
use Botify\Utils\FallbackResponse;
use function Amp\call;
use function Botify\collect;

trait SendMediaGroup
{

    /**
     * Send multiple media as album
     *
     * @param array $args
     * @return Promise<Message[]>
     */
    protected function sendMediaGroup(...$args): Promise
    {
        return call(function () use ($args) {
            $request = yield $this->client->post('sendMediaGroup', $args);
            $response = yield $request->json();

            if (isset($response['result']) && is_array($response['result'])) {
                return collect(array_map(
                    fn($message) => new Message($message), $response['result']
                ));
            }

            return new FallbackResponse($response);
        });
    }
}