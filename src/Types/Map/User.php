<?php

namespace Jove\Types\Map;

use Amp\Producer;
use Amp\Promise;
use Jove\Traits\Actionable;
use Jove\Traits\HasHistory;
use Jove\Traits\Notifiable;
use Jove\Utils\LazyJsonMapper;
use function Amp\call;

/**
 * User
 *
 * @method Int getIsAdmin()
 * @method Int getIsSuperAdmin()
 * @method Int getId()
 * @method bool getIsBot()
 * @method bool getIsSelf()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getUsername()
 * @method string getLanguageCode()
 * @method bool getCanJoinGroups()
 * @method bool getCanReadAllGroupMessages()
 * @method bool getSupportsInlineQueries()
 *
 * @method bool isIsAdmin()
 * @method bool isIsSuperAdmin()
 * @method bool isId()
 * @method bool isIsBot()
 * @method bool isIsSelf()
 * @method bool isFirstName()
 * @method bool isLastName()
 * @method bool isUsername()
 * @method bool isLanguageCode()
 * @method bool isCanJoinGroups()
 * @method bool isCanReadAllGroupMessages()
 * @method bool isSupportsInlineQueries()
 *
 * @method $this setIsAdmin(int $value)
 * @method $this setIsSuperAdmin(int $value)
 * @method $this setId(int $value)
 * @method $this setIsBot(bool $value)
 * @method $this setIsSelf(bool $value)
 * @method $this setFirstName(string $value)
 * @method $this setLastName(string $value)
 * @method $this setUsername(string $value)
 * @method $this setLanguageCode(string $value)
 * @method $this setCanJoinGroups(bool $value)
 * @method $this setCanReadAllGroupMessages(bool $value)
 * @method $this setSupportsInlineQueries(bool $value)
 *
 * @method $this unsetIsAdmin()
 * @method $this unsetIsSuperAdmin()
 * @method $this unsetId()
 * @method $this unsetIsBot()
 * @method $this unsetIsSelf()
 * @method $this unsetFirstName()
 * @method $this unsetLastName()
 * @method $this unsetUsername()
 * @method $this unsetLanguageCode()
 * @method $this unsetCanJoinGroups()
 * @method $this unsetCanReadAllGroupMessages()
 * @method $this unsetSupportsInlineQueries()
 *
 * @property bool $is_admin
 * @property bool $is_super_admin
 * @property Int $id
 * @property bool $is_bot
 * @property bool $is_self
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $language_code
 * @property bool $can_join_groups
 * @property bool $can_read_all_group_messages
 * @property bool $supports_inline_queries
 */
class User extends LazyJsonMapper
{
    use Actionable, HasHistory, Notifiable;

    const JSON_PROPERTY_MAP = [
        'id' => 'int',
        'is_bot' => 'bool',
        'first_name' => 'string',
        'last_name' => 'string',
        'username' => 'string',
        'bio' => 'string',
        'language_code' => 'string',
        'can_join_groups' => 'bool',
        'can_read_all_group_messages' => 'bool',
        'supports_inline_queries' => 'bool',
        'is_super_admin' => 'bool',
        'is_admin' => 'bool',
        'is_self' => 'bool',
    ];

    public function _init()
    {
        parent::_init();

        $this->_setProperty('is_admin', in_array(
            $this->id, config('telegram.admins', []),
        ));

        $this->_setProperty(
            'is_super_admin', $this->id === (int)config('telegram.super_admin')
        );

        $this->_setProperty(
            'is_self', $this->id === (int)config('telegram.user_id')
        );
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return Promise
     */
    public function getProfilePhotos(int $offset = 0, int $limit = 10): Promise
    {
        return call(function () use ($limit, $offset) {
            $profiles = yield $this->getAPI()->getUserProfilePhotos([
                'user_id' => $this->id,
                'offset' => $offset,
                'limit' => $limit,
            ]);

            if ($profiles->isSuccess()) {
                return collect($profiles->photos);
            }

            return collect([]);
        });
    }

    /**
     * Downloading current user profile photos
     *
     * @param int $offset
     * @param int $limit
     * @return Promise
     */
    public function downloadProfilePhotos(int $offset = 0, int $limit = 10): Promise
    {
        if ($limit <= 100) {
            return call(function ($limit, &$offset) {
                $profiles = yield $this->getAPI()->getUserProfilePhotos([
                    'user_id' => $this->id,
                    'offset' => $offset,
                    'limit' => $limit,
                ]);

                if ($profiles->isSuccess()) {
                    return collect(yield gather(array_map(
                        fn(array $photos) => call(fn() => end($photos)->download()),
                        $profiles->photos
                    )));
                }

                return $profiles;
            }, $limit, $offset);
        }

        return call(function () use ($limit) {
            return new Producer(function (callable $emit) use ($limit) {
                $current = 0;
                $offset = 0;
                $total = abs($limit) ?: (1 << 31) - 1;
                $limit = min(100, $total);

                while (true) {
                    if (($chunk = yield $this->getChunk($offset, $limit)) && [$totalCount, $photos] = $chunk) {
                        $offset += count($photos);

                        foreach ($photos as $photo) {
                            yield $emit($photo);

                            $current++;

                            if ($current >= $totalCount || $current >= $total) {
                                return;
                            }
                        }
                    } else {
                        return;
                    }
                }
            });
        });
    }

    private function getChunk($offset, $limit): Promise
    {
        return call(function () use ($limit, $offset) {
            $profiles = yield $this->getAPI()->getUserProfilePhotos([
                'user_id' => $this->id,
                'offset' => $offset,
                'limit' => $limit,
            ]);

            if ($profiles->isSuccess()) {
                return [$profiles->total_count, collect(yield gather(array_map(
                    fn(array $photos) => call(fn() => end($photos)->download()),
                    $profiles->photos
                )))];
            }

            return false;
        });
    }

    private function getNotifiableId()
    {
        return $this->id;
    }
}