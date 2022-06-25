<?php

namespace Jove\Utils;

use Closure;

class Collection
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
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
            fn($item) => $this->toArray(), $this->items
        );
    }
}