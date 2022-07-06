<?php

namespace Jove\Utils;

use Exception;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;

class Logger extends AbstractLogger
{
    use LoggerTrait;

    protected static array $levels = [
        LogLevel::DEBUG => 0,
        LogLevel::INFO => 1,
        LogLevel::NOTICE => 2,
        LogLevel::WARNING => 3,
        LogLevel::ERROR => 4,
        LogLevel::CRITICAL => 5,
        LogLevel::ALERT => 6,
        LogLevel::EMERGENCY => 7,
    ];

    protected int $minLevel;

    public function __construct(int $level = 0)
    {
        $minLevel = !is_null($level) ? $level : match ((int)env('SHELL_VERBOSITY')) {
            -1 => static::$levels[LogLevel::ERROR],
            1 => static::$levels[LogLevel::NOTICE],
            2 => static::$levels[LogLevel::INFO],
            3 => static::$levels[LogLevel::DEBUG]
        };

        if (!isset(array_flip(static::$levels)[$minLevel])) {
            throw new Exception(sprintf(
                'There is no logger level [%s]', $minLevel
            ));
        }

        $this->minLevel = $minLevel;
    }

    public function log($level, $message, array $context = []): void
    {
        if ((static::$levels[$level] < $this->minLevel) || strtolower(config('app.environment')) === 'production') {
            return;
        }

        echo $this->interpolate($level, $message, $context);
    }

    public function interpolate($level, $message, array $context = []): string
    {
        $replace = [];

        if (str_contains($message, '{')) {
            foreach ($context as $key => $value) {
                if (!is_array($value) && (!is_object($value) || method_exists($value, '__toString'))) {
                    $replace['{' . $key . '}'] = $value;
                }
            }

            $message = strtr($message, $replace);
        }

        return sprintln(sprintf(
            '[%s] [%s] %s %s',
            date('Y/m/d H:i:s'),
            $level,
            $message,
            $context ? sprintln(var_export($context, true)) : null
        ));
    }
}