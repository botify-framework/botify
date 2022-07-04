<?php

namespace Jove\Traits;

trait Stringable
{

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