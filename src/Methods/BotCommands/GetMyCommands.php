<?php

namespace Jove\Methods\BotCommands;

use Amp\Promise;
use Jove\Types\Map\BotCommand;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait GetMyCommands
{

    /**
     * @param array $args
     * @return Promise|BotCommand[]
     */
    protected function getMyCommands(...$args): Promise
    {
        return call(function () use ($args) {
            $response = yield $this->post('getMyCommands', isset($args[0])
                ? array_merge(array_shift($args), $args)
                : $args
            );

            if (isset($response['result']) && is_array($response['result'])) {
                return collect(array_map(
                    fn($command) => new BotCommand($command), $response['result']
                ));
            }

            return new FallbackResponse($response);
        });
    }
}