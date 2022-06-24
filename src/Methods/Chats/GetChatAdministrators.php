<?php

namespace Jove\Methods\Chats;

use Amp\Promise;
use Jove\Types\Map\ChatMember;
use Jove\Utils\FallbackResponse;
use function Amp\call;

trait GetChatAdministrators
{

    /**
     * Getting list of all administrators of a chat
     *
     * @param array $args
     * @return Promise|ChatMember[]
     */
    public function getChatAdministrators(...$args): Promise
    {
        return call(function () use ($args) {
            $args = isset($args[0])
                ? array_merge(array_shift($args), $args)
                : $args;

            $response = yield $this->post('getChatAdministrators', $args);

            if (isset($response['result']) && is_array($response['result'])) {
                return array_map(fn($member) => new ChatMember($member), $response['result']);
            }

            return new FallbackResponse($response);
        });
    }
}