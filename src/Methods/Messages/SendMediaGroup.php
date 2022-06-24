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
            if (isset($args[0])) {
                $head = array_shift($args);
                $args = array_merge($head, $args);
            }

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