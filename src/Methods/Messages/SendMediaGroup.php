<?php

namespace Jove\Methods\Messages;

use Amp\Promise;
use Jove\Types\Map\Message;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait SendMediaGroup
{

    /**
     * Send multiple media as album
     *
     * @param array $args
     * @return Promise
     */
    public function sendMediaGroup(...$args): Promise
    {
        return call(function () use ($args) {
            $args = isset($args[0])
                ? array_merge(array_shift($args), $args)
                : $args;

            $response = yield $this->post('sendMediaGroup', $args);

            if (isset($response['result']) && is_array($response['result'])) {
                return array_map(
                    fn($message) => new Message($message), $response['result']
                );
            }

            return new FallbackResponse($response);
        });
    }
}