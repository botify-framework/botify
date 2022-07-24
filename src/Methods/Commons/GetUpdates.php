<?php

namespace Jove\Methods\Commons;

use Amp\Promise;
use Jove\Types\Update;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait GetUpdates
{

    /**
     * @param int $offset
     * @param int $limit
     * @param int $timeout
     * @param array $allowed_updates
     * @return Promise|Update[]
     */
    protected function getUpdates(
        int   $offset = -1,
        int   $limit = 100,
        int   $timeout = 0,
        array $allowed_updates = []
    ): Promise
    {
        return call(function () use (
            $offset,
            $limit,
            $timeout,
            $allowed_updates
        ) {
            $response = yield $this->client->post('getUpdates', compact(
                'offset', 'limit', 'timeout', 'allowed_updates'
            ));

            if (!empty($response['ok'])) {
                return collect(
                    array_map(fn($update) => new Update($update), $response['result'])
                );
            }

            return new FallbackResponse($response);
        });
    }
}