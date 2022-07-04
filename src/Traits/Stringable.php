<?php

namespace Jove\Traits;

trait Stringable
{
    public function endsWith($needles): bool
    {
        return array_some(
            (array)$needles, fn($needle) => str_ends_with($this->getStringableValue(), $needle)
        );
    }

    public function startsWith($needles): bool
    {
        return array_some(
            (array)$needles, fn($needle) => str_starts_with($this->getStringableValue(), $needle)
        );
    }

    public function is($value): bool
    {
        return in_array($this->getStringableValue(), (array)$value);
    }

    public function trim($characters = " \t\n\r\0\x0B")
    {
        return trim($this->getStringableValue(), $characters);
    }

    abstract protected function getStringableValue(): ?string;
}