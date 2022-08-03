<?php

namespace Botify\Methods\BotCommands;

use Amp\Promise;
use Botify\Types\Map\BotCommand;
use Botify\Utils\FallbackResponse;
use function Amp\call;
use function Botify\collect;

trait GetMyCommands
{

    /**
     * @param array $args
     * @return Promise<BotCommand[]>
     */
    protected function getMyCommands(...$args): Promise
    {
        return call(function () use ($args) {
            $request = yield $this->client->post('getMyCommands', $args);
            $response = yield $request->json();

            if (isset($response['result']) && is_array($response['result'])) {
                return collect(array_map(
                    fn($command) => new BotCommand($command), $response['result']
                ));
            }

            return new FallbackResponse($response);
        });
    }
}