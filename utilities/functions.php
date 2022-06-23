<?php

use Amp\Delayed;
use Amp\Promise;

if (!function_exists('retry')) {
    /**
     * @param $times
     * @param callable $callback
     * @param int $sleep
     * @return mixed
     * @throws Exception
     */
    function retry($times, callable $callback, int $sleep = 0): mixed
    {
        static $attempts = 0;
        beginning:
        $attempts++;
        $times--;
        try {
            return $callback($attempts);
        } catch (Exception $e) {
            if ($times < 1) throw $e;
            $sleep && \sleep($sleep);
            goto beginning;
        }
    }
}

if (!function_exists('tap')) {
    /**
     * @param $value
     * @param $callback
     * @return mixed
     */
    function tap($value, $callback): mixed
    {
        $callback($value);

        return $value;
    }
}

if (!function_exists('asleep')) {
    /**
     * @param $time
     * @param $value
     * @return Promise
     */
    function asleep($time, $value = null): Promise
    {
        return \Amp\call(function () use ($time, $value) {
            return new Delayed($time, $value);
        });
    }
}