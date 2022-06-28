<?php

use Amp\Delayed;
use Amp\Promise;
use Jove\Utils\Collection;
use Jove\Utils\Config;
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

if (!function_exists('gather')) {

    function gather($promises): Promise
    {
        return Promise\all($promises);
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
            return new Delayed($time * 1000, $value);
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

if (!function_exists('base_path')) {
    /**
     * Resolve base path
     *
     * @param $path
     * @return string
     */
    function base_path($path): string
    {
        return __DIR__ . '/../' . trim($path, '/');
    }
}

if (!function_exists('storage_path')) {
    /**
     * Resolve storage path
     *
     * @param string $path
     * @return string
     */
    function storage_path(string $path = ''): string
    {
        return base_path('/storage/' . trim($path, '/'));
    }
}

if (!function_exists('config_path')) {
    function config_path($path): string
    {
        return base_path('/config/' . trim($path, '/'));
    }
}

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return getenv($key) ?? $default;
    }
}

if (!function_exists('value')) {
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('array_exists')) {

    function array_exists($array, $key): bool
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }
}

if (!function_exists('array_accessible')) {

    function array_accessible($value): bool
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }
}

if (!function_exists('array_collapse')) {

    function array_collapse(iterable $array): array
    {
        $results = [];

        foreach ($array as $values) {
            if (!is_array($values)) {
                continue;
            }

            $results[] = $values;
        }

        return array_merge([], ...$results);
    }
}

if (!function_exists('data_get')) {

    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return value($default ?? $target);
        }

        $key = is_array($key) ? $key : explode('.', $key);

        foreach ($key as $i => $segment) {
            unset($key[$i]);

            if (is_null($segment)) {
                return $target;
            }

            if ($segment === '*') {
                if (!is_array($target)) {
                    return value($default);
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return in_array('*', $key) ? array_collapse($result) : $result;
            }

            if (array_accessible($target) && array_exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (!function_exists('array_set')) {

    function array_set(array &$array, ?string $key, $value): array
    {
        if (is_null($key)) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        foreach ($keys as $i => $key) {
            if (count($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }
}

if (!function_exists('data_set')) {
    function data_set(&$target, $key, $value, bool $overwrite = true)
    {
        $segments = is_array($key) ? $key : explode('.', $key);

        if (($segment = array_shift($segments)) === '*') {
            if (!array_accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    data_set($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (array_accessible($target)) {
            if ($segments) {
                if (!array_exists($target, $segment)) {
                    $target[$segment] = [];
                }

                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || !array_exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (is_object($target)) {
            if ($segments) {
                if (!isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                data_set($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || !isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    }
}

if (!function_exists('config')) {

    function config($id = null, $default = null)
    {
        $config = Config::make();

        if (is_null($id)) {
            return $config;
        }

        if (is_array($id)) {
            return $config->set($id);
        }

        return $config->get($id, $default);
    }
}

if (!function_exists('repeat')) {
    /**
     * Repeat a code n times
     * @param int $times
     * @param callable $callback
     * @param array $iterable
     * @param ...$args
     * @return array
     */
    function repeat(int $times, callable $callback, array $iterable = [], ...$args)
    {
        $returns = [];

        if (!empty($iterable)) {
            foreach ($iterable as $index => $item) {
                $returns[] = $callback($item, $index, ... $args);
            }
        } else {
            for ($n = 1; $n < $times; $n++)
                $returns[] = $callback(... $args);
        }

        return $returns;
    }
}

if (!function_exists('arepeat')) {
    /**
     * Asynchronous version of repeat
     *
     * @param int $times
     * @param callable $callback
     * @param array $iterable
     * @return Promise
     */
    function arepeat(int $times, callable $callback, array $iterable = [], ...$args): Promise
    {
        return gather(repeat($times, $callback, $iterable));
    }
}