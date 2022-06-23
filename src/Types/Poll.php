<?php
namespace Jove\Types\Map;

use Jove\Utils\LazyJsonMapper;

/**
 * Poll
 *
 * @method string getId()
 * @method string getQuestion()
 * @method PollOption[] getOptions()
 * @method Int getTotalVoterCount()
 * @method Bool getIsClosed()
 * @method Bool getIsAnonymous()
 * @method string getType()
 * @method Bool getAllowsMultipleAnswers()
 * @method Int getCorrectOptionId()
 * @method string getExplanation()
 * @method MessageEntity[] getExplanationEntities()
 * @method Int getOpenPeriod()
 * @method Int getCloseDate()
 *
 * @method bool isId()
 * @method bool isQuestion()
 * @method bool isOptions()
 * @method bool isTotalVoterCount()
 * @method bool isIsClosed()
 * @method bool isIsAnonymous()
 * @method bool isType()
 * @method bool isAllowsMultipleAnswers()
 * @method bool isCorrectOptionId()
 * @method bool isExplanation()
 * @method bool isExplanationEntities()
 * @method bool isOpenPeriod()
 * @method bool isCloseDate()
 *
 * @method $this setId(string $value)
 * @method $this setQuestion(string $value)
 * @method $this setOptions(PollOption[] $value)
 * @method $this setTotalVoterCount(int $value)
 * @method $this setIsClosed(bool $value)
 * @method $this setIsAnonymous(bool $value)
 * @method $this setType(string $value)
 * @method $this setAllowsMultipleAnswers(bool $value)
 * @method $this setCorrectOptionId(int $value)
 * @method $this setExplanation(string $value)
 * @method $this setExplanationEntities(MessageEntity[] $value)
 * @method $this setOpenPeriod(int $value)
 * @method $this setCloseDate(int $value)
 *
 * @method $this unsetId()
 * @method $this unsetQuestion()
 * @method $this unsetOptions()
 * @method $this unsetTotalVoterCount()
 * @method $this unsetIsClosed()
 * @method $this unsetIsAnonymous()
 * @method $this unsetType()
 * @method $this unsetAllowsMultipleAnswers()
 * @method $this unsetCorrectOptionId()
 * @method $this unsetExplanation()
 * @method $this unsetExplanationEntities()
 * @method $this unsetOpenPeriod()
 * @method $this unsetCloseDate()
 *
 * @property string $id
 * @property string $question
 * @property PollOption[] $options
 * @property Int $total_voter_count
 * @property Bool $is_closed
 * @property Bool $is_anonymous
 * @property string $type
 * @property Bool $allows_multiple_answers
 * @property Int $correct_option_id
 * @property string $explanation
 * @property MessageEntity[] $explanation_entities
 * @property Int $open_period
 * @property Int $close_date
 */

class Poll extends LazyJsonMapper{
	const JSON_PROPERTY_MAP = [		'id' => 'string',		'question' => 'string',		'options' => 'PollOption[]',		'total_voter_count' => 'int',		'is_closed' => 'Bool',		'is_anonymous' => 'Bool',		'type' => 'string',		'allows_multiple_answers' => 'Bool',		'correct_option_id' => 'int',		'explanation' => 'string',		'explanation_entities' => 'MessageEntity[]',		'open_period' => 'int',		'close_date' => 'int',	];
}