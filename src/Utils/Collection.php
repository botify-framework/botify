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

        $filtered = array_filter($this->items, $fn);

        return array_shift($filtered);
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
            return array_pop($this->items);
        }

        $filtered = array_filter($this->items, $fn);

        return array_pop($filtered);
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