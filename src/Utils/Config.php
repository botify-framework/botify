<?php

namespace Jove\Utils;

use ArrayAccess;
use Closure;

class Config implements ArrayAccess
{

    public static array $items = [];

    private static array $loadedDirs = [];

    public function __construct()
    {
        // Load default configs
        $this->loadFromDir(abs_path(__DIR__ . '/../../config'));
        // Override configs from base directory
        $this->loadFromDir(config_path());

        // Bind all closures to Config class
        static::$items = array_map_recursive(function ($item) {
            if ($item instanceof Closure) {
                $item = $item->bindTo($this);
            }

            return $item;
        }, static::$items);
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

                            static::$items[$namespace] = array_merge(
                                static::$items[$namespace] ?? [], $data
                            );
                        }
                    }
                }
            }
        }
    }

    /**
     * @param $id
     * @param array $with
     * @return void
     */
    public function merge($id, array $with)
    {
        $namespace = $this->splitNamespace($id, $key);

        $data = $this->load($namespace);

        static::$items[$namespace] = data_set($data, $key, array_merge_recursive(data_get(
            $data, $key, []
        ), $with));
    }

    /**
     * @param $id
     * @param $key
     * @return string
     */
    private function splitNamespace($id, &$key = null): string
    {
        $splited = explode('.', trim($id, '.'), 2);

        if (count($splited) < 2) {
            $splited[1] = null;
        }

        [$namespace, $key] = $splited;

        return $namespace;
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
        return static::$items;
    }

    /**
     * @param $id
     * @param $value
     * @return void
     */
    public function prepend($id, $value)
    {
        $array = $this->get($id);

        array_unshift($array, $value);

        $this->set($id, $array);
    }

    /**
     * @param $id
     * @param $default
     * @return array|mixed
     */
    public function get($id, $default = null): mixed
    {
        if (is_array($id)) {
            return $this->getMany($id);
        }

        $namespace = $this->splitNamespace($id, $key);

        return value(data_get($this->load($namespace), $key, $default));
    }

    public function getMany($ids): array
    {
        $config = [];

        foreach ($ids as $id => $default) {
            if (is_numeric($id)) {
                [$id, $default] = [$default, null];
            }
            $config[] = $this->get($id, $default);
        }

        return $config;
    }

    /**
     * @param $id
     * @param $value
     * @return void
     */
    public function set($id, $value = null): void
    {
        $ids = is_array($id) ? $id : [$id => $value];

        foreach ($ids as $id => $value)
            data_set(static::$items, $id, $value, true);
    }

    /**
     * @param $id
     * @param $value
     * @return void
     */
    public function push($id, $value)
    {
        $array = $this->get($id);

        $array[] = $value;

        $this->set($id, $array);
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