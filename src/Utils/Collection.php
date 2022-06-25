<?php

namespace Jove\Utils;

class Collection
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
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