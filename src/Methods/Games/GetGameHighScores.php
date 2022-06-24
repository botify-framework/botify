<?php

namespace Jove\Methods\Games;

use Amp\Promise;
use Jove\Types\Map\GameHighScore;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait GetGameHighScores
{

    /**
     * Get list of high scores of a game
     *
     * @param array $args
     * @return Promise|GameHighScore[]
     */
    public function getGameHighScores(...$args): Promise
    {
        return call(function () use ($args) {
            $response = yield $this->post('getGameHighScores', isset($args[0])
                ? array_merge(array_shift($args), $args)
                : $args
            );

            if (isset($response['result']) && is_array($response['result'])) {
                return array_map(fn($member) => new GameHighScore($member), $response['result']);
            }

            return new FallbackResponse($response);
        });
    }
}