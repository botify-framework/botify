<?php

namespace Jove\Types\Map;

use Amp\Promise;
use Jove\Utils\FileSystem;
use Jove\Utils\LazyJsonMapper;
use function Amp\call;
use function Amp\File\createDirectoryRecursively;
use function Amp\File\isDirectory;
use function Amp\File\openFile;

/**
 * User
 *
 * @method Int getIsAdmin()
 * @method Int getIsSuperAdmin()
 * @method Int getId()
 * @method bool getIsBot()
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

    const JSON_PROPERTY_MAP = [
        'id' => 'int',
        'is_bot' => 'bool',
        'first_name' => 'string',
        'last_name' => 'string',
        'username' => 'string',
        'language_code' => 'string',
        'can_join_groups' => 'bool',
        'can_read_all_group_messages' => 'bool',
        'supports_inline_queries' => 'bool',
        'is_super_admin' => 'bool',
        'is_admin' => 'bool',
    ];

    public function _init()
    {
        parent::_init();

        $this->_setProperty('is_admin', in_array(
            $this->id, config('telegram.admins', []),
        ));

        $this->_setProperty(
            'is_super_admin', $this->id === (int)config('super_admin')
        );
    }

    /**
     * Downloading current user profile photos
     *
     * @param int $offset
     * @param int $limit
     * @return Promise
     */
    public function download_profile_photos(int $offset = 0, int $limit = 10): Promise
    {
        return call(function () use ($limit, $offset) {
            $profiles = yield $this->api->getUserProfilePhotos(
                user_id: $this->id,
                offset: $offset,
                limit: $limit,
            );

            if ($profiles->isSuccess()) {
                return collect(yield gather(array_map(
                    fn(array $photos) => call(fn() => end($photos)->download()),
                    $profiles->photos
                )));
            }

            return false;
        });
    }
}