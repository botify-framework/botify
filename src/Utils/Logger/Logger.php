<?php

namespace Botify\Utils\Logger;

use Botify\Utils\Logger\Colorize\Colorize;
use ErrorException;
use Exception;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;
use Throwable;
use function Botify\array_some;
use function Botify\base_path;
use function Botify\config;
use function Botify\env;
use function Botify\sprintln;

class Logger extends AbstractLogger
{
    use LoggerTrait;

    /**
     * Logger types
     */
    const ECHO_TYPE = 1;
    const FILE_TYPE = 2;
    const DEFAULT_TYPE = self::ECHO_TYPE;

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

    protected array $excepts = [
        'stream_socket_accept(): Accept failed: Connection timed out',
    ];

    protected int $minLevel;

    protected int $type = self::DEFAULT_TYPE;

    /**
     * @throws Exception
     */
    public function __construct(int $level = 0, $type = self::DEFAULT_TYPE)
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
        $this->type = $type;

        set_error_handler(function ($code, $message, $file, $line) {
            if (!array_some($this->excepts, fn($error) => str_contains($message, $error)))
                $this->error(new ErrorException($message, 0, $code, $file, $line));
        });

        set_exception_handler(function ($e) {
            $message = $e->getMessage();
            if (!array_some($this->excepts, fn($error) => str_contains($message, $error)))
                $this->critical($e);
        });
    }

    public function log($level, $message, array $context = []): void
    {
        if ((static::$levels[$level] < $this->minLevel) || strtolower(config('app.environment')) === 'production') {
            return;
        }

        $log = $this->interpolate($level, $message, $context);

        $loggerFile = $this->getLoggerFile();

        if (filesize($loggerFile) > config('app.logger_max_size')) {
            file_put_contents($loggerFile, null);
        }

        if ($this->type & static::ECHO_TYPE) {
            \Botify\file_put_contents('php://output', Colorize::log($level, $log));
        }

        if ($this->type & static::FILE_TYPE) {
            is_dir($logsDir = dirname($logFile = config('app.logger_file', base_path('botify.log'))))
            || mkdir($logsDir, recursive: true);
            file_put_contents($logFile, sprintln($log), FILE_APPEND);
        }
    }

    public function interpolate($level, $message, array $context = []): string
    {
        $replace = [];

        if (str_contains($message, '{')) {
            foreach ($context as $key => $value) {
                if ($value instanceof Throwable) {
                    $replace['{' . $key . '}'] = json_encode($this->exceptionToArray($value));
                    unset($context[$key]);
                } else {
                    if (!is_array($value) && (!is_object($value) || method_exists($value, '__toString'))) {
                        $replace['{' . $key . '}'] = $value;
                        unset($context[$key]);
                    } else {
                        if (is_array($value)) {
                            $replace['{' . $key . '}'] = json_encode($value, 448);
                            unset($context[$key]);
                        }
                    }
                }
            }

            $message = strtr($message, $replace);
        }

        return sprintf(
            '[%s] [%s] %s %s',
            date('Y/m/d H:i:s'),
            $level,
            $message,
            $context ? sprintln(var_export($context)) : null
        );
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

    private function getLoggerFile()
    {
        is_dir($logsDir = dirname($logFile = config('app.logger_file', base_path('botify.log'))))
        || mkdir($logsDir, recursive: true);
        file_exists($logFile) || touch($logFile);
        return $logFile;
    }
}