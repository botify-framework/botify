<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * PollAnswer
 *
 * @method string getPollId()
 * @method User getUser()
 * @method int[] getOptionIds()
 *
 * @method bool isPollId()
 * @method bool isUser()
 * @method bool isOptionIds()
 *
 * @method $this setPollId(string $value)
 * @method $this setUser(User $value)
 * @method $this setOptionIds(int[] $value)
 *
 * @method $this unsetPollId()
 * @method $this unsetUser()
 * @method $this unsetOptionIds()
 *
 * @property string $poll_id
 * @property User $user
 * @property int[] $option_ids
 */
class PollAnswer extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'poll_id' => 'string',
        'user' => 'User',
        'option_ids' => 'int[]',
    ];
}