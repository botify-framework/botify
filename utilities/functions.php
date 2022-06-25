<?php

use Amp\Delayed;
use Amp\Promise;
use Jove\Utils\Collection;
use function Amp\call;

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
        return call(function () use ($time, $value) {
            return new Delayed($time, $value);
        });
    }
}

if (!function_exists('collect')) {
    /**
     * @param array $items
     * @param bool $recursive
     * @return Collection
     */
    function collect(array $items, bool $recursive = false): Collection
    {
        if ($recursive === true) {
            foreach ($items as &$item) {
                if (is_array($item)) {
                    $item = collect($item);
                }
            }
        }
        return new Collection($items);
    }
}

if (!function_exists('is_collection')) {
    /**
     * Check the $value is a collection
     *
     * @param $value
     * @return bool
     */
    function is_collection($value): bool
    {
        return $value instanceof Collection;
    }
}