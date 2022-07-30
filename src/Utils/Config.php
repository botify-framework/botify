<?php

namespace Botify\Utils;

use ArrayAccess;
use Closure;
use function Botify\abs_path;
use function Botify\array_map_recursive;
use function Botify\config_path;
use function Botify\dotty;
use function Botify\value;

class Config implements ArrayAccess
{

    public static Dotty $items;

    private static array $loadedDirs = [];

    public function __construct()
    {
        static::$items = dotty();
        // Load default configs
        $this->loadFromDir(abs_path(__DIR__ . '/../../config'));
        // Override configs from base directory
        $this->loadFromDir(config_path());
    }

    private function mapIntoLazyItems(array $items): array
    {
        return array_map_recursive(function ($item) {
            if ($item instanceof Closure) {
                $item = $item();
            }

            return $item;
        }, $items);
    }

    /**
     * Load all configs contains in a directory
     *
     * @param string $dir
     * @return void
     */
    public function loadFromDir(string $dir)
    {
        if (!in_array($dir, static::$loadedDirs)) {
            if (is_dir($dir)) {
                static::$loadedDirs[] = $dir;
                if ($files = glob(rtrim($dir, '/') . '/*.php')) {
                    foreach ($files as $file) {
                        if (is_array($data = require_once $file)) {
                            $namespace = pathinfo($file, PATHINFO_FILENAME);

                            static::$items[$namespace] = $this->mapIntoLazyItems(array_merge(
                                static::$items[$namespace] ?? [], $data
                            ));
                        }
                    }
                }
            }
        }
    }

    /**
     * @param $key
     * @param array $value
     * @return Config
     */
    public function merge($key, array $value): static
    {
        static::$items->mergeRecursive($key, $value);

        return $this;
    }

    /**
     * Load specified key data from config
     *
     * @param $key
     * @return array
     */
    public function load($key): array
    {
        return static::$items[$key] ?? [];
    }

    public static function make()
    {
        return new static();
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return static::$items->all();
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function prepend($key, $value)
    {
        $array = (array)$this->get($key);

        array_unshift($array, $value);

        $this->set($key, $array);
    }

    /**
     * @param $key
     * @param null $default
     * @return array|mixed
     */
    public function get($key, $default = null): mixed
    {
        return value(static::$items[$key] ?? $default);
    }

    public function getMany($keys): array
    {
        $config = [];

        foreach ($keys as $key => $default) {
            if (is_numeric($key)) {
                [$key, $default] = [$default, null];
            }

            $config[] = $this->get($key, $default);
        }

        return $config;
    }

    /**
     * @param $keys
     * @param null $value
     * @return Config
     */
    public function set($keys, $value = null): Config
    {
        $keys = is_array($keys) ? $keys : [$keys => $value];

        foreach ($keys as $key => $value)
            static::$items[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return Config
     */
    public function push($key, $value)
    {
        static::$items->push($key, $value);

        return $this;
    }

    /**
     * @param $key
     * @param $default
     * @return array|mixed|null
     */
    public function pull($key, $default = null)
    {
        return static::$items->pull($key, $default);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset(static::$items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_null($offset)) {
            $this->set($offset, $value);
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset(static::$items[$offset]);
    }
}