<?php

namespace Jove\Utils\Logger;

use Exception;
use Jove\Utils\Logger\Colorize\Colorize;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;
use Throwable;

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

    public function exceptionToArray(Throwable $e): array
    {
        return [
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'code' => $e->getCode(),
            'backtrace' => array_slice($e->getTrace(), 0, 3),
        ];
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
                if ($value instanceof Throwable) {
                    $replace['{' . $key . '}'] = $this->exceptionToArray($value);
                } else {
                    if (!is_array($value) && (!is_object($value) || method_exists($value, '__toString'))) {
                        $replace['{' . $key . '}'] = $value;
                    } else {
                        if (is_array($value)) {
                            $replace['{' . $key . '}'] = json_encode($value, 448);
                        }
                    }
                }
            }

            $message = strtr($message, $replace);
        }

        return Colorize::log($level, sprintf(
            '[%s] [%s] %s %s',
            date('Y/m/d H:i:s'),
            $level,
            $message,
            $context ? sprintln($context) : null
        ));
    }
}