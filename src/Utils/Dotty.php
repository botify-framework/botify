<?php

namespace Botify\Utils;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class Dotty implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    protected array $items = [];

    public function __construct($items = [], $parse = false)
    {
        $items = $this->getArrayItems($items);

        if ($parse) {
            $this->set($items);
        } else {
            $this->items = $items;
        }
    }

    protected function getArrayItems($items): array
    {
        if (is_array($items)) {
            return $items;
        }

        if ($items instanceof self) {
            return $items->all();
        }

        return (array)$items;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function set($keys, $value = null): Dotty
    {
        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                $this->set($key, $value);
            }

            return $this;
        }

        $items = &$this->items;

        if (is_string($keys)) {
            foreach (explode('.', $keys) as $key) {
                if (!isset($items[$key]) || !is_array($items[$key])) {
                    $items[$key] = [];
                }

                $items = &$items[$key];
            }
        }

        $items = $value;

        return $this;
    }

    public static function __set_state(array $items): object
    {
        return (object)$items;
    }

    public function add($keys, $value = null): Dotty
    {
        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                $this->add($key, $value);
            }
        } elseif ($this->get($keys) === null) {
            $this->set($keys, $value);
        }

        return $this;
    }

    public function get($key = null, $default = null)
    {
        if ($key === null) {
            return $this->items;
        }

        if ($this->exists($this->items, $key)) {
            return $this->items[$key];
        }

        if (!is_string($key) || !str_contains($key, '.')) {
            return $default;
        }

        $items = $this->items;

        foreach (explode('.', $key) as $segment) {
            if (!is_array($items) || !$this->exists($items, $segment)) {
                return $default;
            }

            $items = &$items[$segment];
        }

        return $items;
    }

    protected function exists($array, $key): bool
    {
        return array_key_exists($key, $array);
    }

    public function count($key = null): int
    {
        return count($this->get($key));
    }

    public function flatten($delimiter = '.', $items = null, $prepend = ''): array
    {
        $flatten = [];

        if ($items === null) {
            $items = $this->items;
        }

        foreach ($items as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $flatten[] = $this->flatten($delimiter, $value, $prepend . $key . $delimiter);
            } else {
                $flatten[] = [$prepend . $key => $value];
            }
        }

        return array_merge(...$flatten);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function isEmpty($keys = null): bool
    {
        if ($keys === null) {
            return empty($this->items);
        }

        $keys = (array)$keys;

        foreach ($keys as $key) {
            if (!empty($this->get($key))) {
                return false;
            }
        }

        return true;
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }

    public function merge($key, $value = []): Dotty
    {
        if (is_array($key)) {
            $this->items = array_merge($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array)$this->get($key);
            $value = array_merge($items, $this->getArrayItems($value));

            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = array_merge($this->items, $key->all());
        }

        return $this;
    }

    public function mergeRecursive($key, $value = []): Dotty
    {
        if (is_array($key)) {
            $this->items = array_merge_recursive($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array)$this->get($key);
            $value = array_merge_recursive($items, $this->getArrayItems($value));

            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = array_merge_recursive($this->items, $key->all());
        }

        return $this;
    }

    public function mergeRecursiveDistinct($key, $value = []): Dotty
    {
        if (is_array($key)) {
            $this->items = $this->arrayMergeRecursiveDistinct($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array)$this->get($key);
            $value = $this->arrayMergeRecursiveDistinct($items, $this->getArrayItems($value));

            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = $this->arrayMergeRecursiveDistinct($this->items, $key->all());
        }

        return $this;
    }

    protected function arrayMergeRecursiveDistinct(array $array1, array $array2): array
    {
        $merged = &$array1;

        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = $this->arrayMergeRecursiveDistinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }

    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    public function has($keys): bool
    {
        $keys = (array)$keys;

        if (!$this->items || $keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $items = $this->items;

            if ($this->exists($items, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (!is_array($items) || !$this->exists($items, $segment)) {
                    return false;
                }

                $items = $items[$segment];
            }
        }

        return true;
    }

    public function offsetGet($offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;

            return;
        }

        $this->set($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        $this->delete($offset);
    }

    public function delete($keys): Dotty
    {
        $keys = (array)$keys;

        foreach ($keys as $key) {
            if ($this->exists($this->items, $key)) {
                unset($this->items[$key]);

                continue;
            }

            $items = &$this->items;
            $segments = explode('.', $key);
            $lastSegment = array_pop($segments);

            foreach ($segments as $segment) {
                if (!isset($items[$segment]) || !is_array($items[$segment])) {
                    continue 2;
                }

                $items = &$items[$segment];
            }

            unset($items[$lastSegment]);
        }

        return $this;
    }

    public function pull($key = null, $default = null)
    {
        if ($key === null) {
            $value = $this->all();
            $this->clear();

            return $value;
        }

        $value = $this->get($key, $default);
        $this->delete($key);

        return $value;
    }

    public function clear($keys = null): Dotty
    {
        if ($keys === null) {
            $this->items = [];

            return $this;
        }

        $keys = (array)$keys;

        foreach ($keys as $key) {
            $this->set($key, []);
        }

        return $this;
    }

    public function push($key, $value = null): Dotty
    {
        if ($value === null) {
            $this->items[] = $key;

            return $this;
        }

        $items = $this->get($key);

        if (is_array($items) || $items === null) {
            $items[] = $value;
            $this->set($key, $items);
        }

        return $this;
    }

    public function replace($key, $value = []): Dotty
    {
        if (is_array($key)) {
            $this->items = array_replace($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array)$this->get($key);
            $value = array_replace($items, $this->getArrayItems($value));

            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = array_replace($this->items, $key->all());
        }

        return $this;
    }

    public function setArray($items): static
    {
        $this->items = $this->getArrayItems($items);

        return $this;
    }

    public function setReference(array &$items): Dotty
    {
        $this->items = &$items;

        return $this;
    }

    public function toJson($key = null, $options = 0): string
    {
        if (is_string($key)) {
            return json_encode($this->get($key), $options);
        }

        $options = $key === null ? 0 : $key;

        return json_encode($this->items, $options);
    }
}