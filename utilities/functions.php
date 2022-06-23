<?php

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
        begining:
        $attempts++;
        $times--;
        try {
            return $callback($attempts);
        } catch (Exception $e) {
            if ($times < 1) throw $e;
            $sleep && sleep($sleep);
            goto begining;
        }
    }
}