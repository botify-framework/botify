<?php

namespace Botify\Methods\Chats;

use Amp\Promise;
use Botify\Types\Map\ChatMember;
use Botify\Utils\FallbackResponse;
use function Amp\call;

trait GetChatAdministrators
{

    /**
     * Getting list of all administrators of a chat
     *
     * @param array $args
     * @return Promise|ChatMember[]
     */
    protected function getChatAdministrators(...$args): Promise
    {
        return call(function () use ($args) {
            $response = yield $this->client->post('getChatAdministrators', $args);

            if (isset($response['result']) && is_array($response['result'])) {
                return collect(array_map(
                    fn($member) => new ChatMember($member), $response['result']
                ));
            }

            return new FallbackResponse($response);
        });
    }
}