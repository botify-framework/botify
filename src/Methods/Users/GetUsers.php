<?php

namespace Botify\Methods\Users;

use Amp\Promise;
use Botify\Types\Map\User;
use function Amp\call;
use function Botify\collect;
use function Botify\gather;

trait GetUsers
{

    /**
     * @param $id
     * @return Promise<bool|User>
     */
    protected function getUser($id): Promise
    {
        return call(function () use ($id) {
            $id = strtolower(trim($id, '@'));

            if (empty($id)) {
                return false;
            } elseif (!is_numeric($id) && $id !== 'me') {
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
            $promises = [];

            foreach ($ids as $id) {
                $promises[$id] = $this->getChat(
                    chat_id: $id
                );
            }

            return collect(yield gather($promises))->where(
                fn($response) => $response->isSuccess() && $response->type === 'private'
            )->map(fn($user) => new User($user->toArray()));
        });
    }
}