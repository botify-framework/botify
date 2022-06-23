<?php

namespace Jove\Methods;

use Amp\Promise;
use Jove\Types\Update;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait GetUpdates
{

    public function getUpdates(
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
            $response = yield $this->post('getUpdates', compact(
                'offset', 'limit', 'timeout', 'allowed_updates'
            ));

            if (!empty($response['ok'])) {
                return array_map(fn($update) => new Update($update), $response['result']);
            }

            return new FallbackResponse($response);
        });
    }
}