<?php

namespace Jove\Utils;

class Config
{

    public static array $items = [];

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
        return static::$items[$key] ??= value(function () use ($key) {
            if (file_exists($path = config_path($key . '.php'))) {
                return is_array($data = require_once $path) ? $data : [];
            }

            return [];
        });
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
     * @param $value
     * @return void
     */
    public function push($id, $value)
    {
        $array = $this->get($id);

        $array[] = $value;

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
}