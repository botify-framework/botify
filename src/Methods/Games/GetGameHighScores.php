<?php

namespace Botify\Methods\Games;

use Amp\Promise;
use Botify\Types\Map\GameHighScore;
use Botify\Utils\FallbackResponse;
use function Amp\call;
use function Botify\collect;

trait GetGameHighScores
{

    /**
     * Get list of high scores of a game
     *
     * @param array $args
     * @return Promise<GameHighScore[]>
     */
    protected function getGameHighScores(...$args): Promise
    {
        return call(function () use ($args) {
            $request = yield $this->client->post('getGameHighScores', $args);
            $response = yield $request->json();

            if (isset($response['result']) && is_array($response['result'])) {
                return collect(array_map(
                    fn($member) => new GameHighScore($member), $response['result']
                ));
            }

            return new FallbackResponse($response);
        });
    }
}