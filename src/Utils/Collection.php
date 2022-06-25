<?php

namespace Jove\Utils;

use ArrayIterator;
use Closure;
use Countable;
use IteratorAggregate;

class Collection implements IteratorAggregate, Countable
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param $value
     * @return Collection
     */
    public function push($value): Collection
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * Merge current items with new items
     *
     * @param $items
     * @return Collection
     */
    public function merge($items): Collection
    {
        $this->items += $items;
        return clone $this;
    }

    /**
     * Get first element in the collection that passes a given condition filter
     *
     * @param $fn
     * @return mixed
     */
    public function sole($fn): mixed
    {
        $items = $this->unless(is_null($fn))->where($fn);

        if (1 === $items->count())
            return $items->first();

        return false;
    }

    /**
     * @param $value
     * @param ?callable $callback
     * @param ?callable $default
     * @return mixed
     */
    public function unless($value, ?callable $callback = null, ?callable $default = null): mixed
    {
        $value = $value instanceof Closure ? $value($this) : $value;

        if (!$callback) {
            return new class($this, !$value) {
                /**
                 * @var mixed
                 */
                private $target;

                /**
                 * @var bool
                 */
                private $condition;

                public function __construct($target, $condition)
                {
                    $this->target = $target;
                    $this->condition = $condition;
                }

                public function __get($name)
                {
                    return $this->condition
                        ? $this->target->{$name}
                        : $this->target;
                }

                public function __call($name, $arguments)
                {
                    return $this->condition
                        ? $this->target->{$name}(... $arguments)
                        : $this->target;
                }
            };
        }

        if (!$value) {
            return $callback($this, $value) ?? $this;
        } elseif ($default) {
            return $default($this, $value) ?? $this;
        }

        return $this;
    }

    /**
     * @param $value
     * @param ?callable $callback
     * @param ?callable $default
     * @return mixed
     */
    public function when($value, ?callable $callback = null, ?callable $default = null): mixed
    {
        $value = $value instanceof Closure ? $value($this) : $value;

        if (!$callback) {
            return new class($this, $value) {
                /**
                 * @var mixed
                 */
                private $target;

                /**
                 * @var bool
                 */
                private $condition;

                public function __construct($target, $condition)
                {
                    $this->target = $target;
                    $this->condition = $condition;
                }

                public function __get($name)
                {
                    return $this->condition
                        ? $this->target->{$name}
                        : $this->target;
                }

                public function __call($name, $arguments)
                {
                    return $this->condition
                        ? $this->target->{$name}(... $arguments)
                        : $this->target;
                }
            };
        }

        if ($value) {
            return $callback($this, $value) ?? $this;
        } elseif ($default) {
            return $default($this, $value) ?? $this;
        }

        return $this;
    }

    /**
     * Filtering collection items
     *
     * @param $fn
     * @return Collection
     */
    public function where($fn): Collection
    {
        return new self(
            array_filter($this->items, $fn)
        );
    }

    /**
     * Map into collection items
     *
     * @param Closure $fn
     * @return Collection
     */
    public function map(Closure $fn): Collection
    {
        return new self(
            array_map($fn, $this->items)
        );
    }

    /**
     * Get first element of collection items
     *
     * @param ?Closure $fn
     * @return mixed
     */
    public function first(?Closure $fn = null): mixed
    {
        if (empty($fn)) {
            return array_shift($this->items);
        }

        $filtered = $this->where($fn);

        return $filtered->shift();
    }

    /**
     * Get last element of collection items
     *
     * @param ?Closure $fn
     * @return mixed
     */
    public function last(?Closure $fn = null): mixed
    {
        if (empty($fn)) {
            return $this->pop();
        }

        $filtered = $this->where($fn);

        return $filtered->pop();
    }

    public function pop()
    {
        return array_pop($this->items);
    }

    public function shift()
    {
        return array_shift($this->items);
    }

    /**
     * Checking correct collection is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Checking correct collection is not empty
     *
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Convert collection object to string
     *
     * @return string
     */
    public function __toString(): string
    {
        return json_encode($this->items);
    }

    /**
     * Convert collection options to array
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            fn($item) => $item->toArray(), $this->items
        );
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Get count of items
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }
}