<?php

namespace Botify\Methods\Users;

use Amp\Promise;
use Botify\Types\Map\User;
use function Amp\call;

trait GetUsers
{

    /**
     * @param $id
     * @return Promise
     */
    protected function getUser($id): Promise
    {
        return call(function () use ($id) {
            $id = strtolower(trim($id, '@'));

            if (!is_numeric($id) && $id !== 'me') {
                $id = yield $this->redis?->getMap('users')
                    ->getValue($id);
            }

            $response = yield $this->getChat([
                'chat_id' => $id,
            ]);

            if ($response->isSuccess() && $response->type === 'private') {
                return new User($response->toArray());
            }

            return false;
        });
    }

    /**
     * @param array $ids
     * @return Promise
     */
    protected function getUsers(array $ids): Promise
    {
        return call(function () use ($ids) {
            return collect(yield gather(array_map(
                fn($id) => $this->getChat(
                    chat_id: $id
                ), $ids
            )))->where(
                fn($response) => $response->isSuccess() && $response->type === 'private'
            )->map(fn($user) => new User($user->toArray()));
        });
    }
}