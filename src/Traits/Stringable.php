<?php

namespace Jove\Traits;

trait Stringable
{
    /**
     * Get string after a phrase
     *
     * @param string $search
     * @return string
     */
    public function after(string $search): string
    {
        return $search === '' ? $this->value() : value(function () use ($search) {
            $split = explode($search, $this->value(), 2);

            return end($split);
        });
    }

    /**
     * Get string after latest a phrase
     *
     * @param string $search
     * @return string
     */
    public function afterLast(string $search): string
    {
        return $search === '' ? $this->value() : value(function () use ($search) {
            if (false === $position = mb_strrpos($this->value(), $search)) {
                return $this->value();
            }

            return mb_substr($this->value(), $position + mb_strlen($search));
        });
    }

    /**
     * Get string before a phrase
     *
     * @param string $search
     * @return string
     */
    public function before(string $search): string
    {
        return $search === '' ? $this->value() : value(function () use ($search) {
            $result = strstr($this->value(), $search, true);

            return $result === false ? $this->value() : $result;
        });
    }

    /**
     * Get string before latest a phrase
     *
     * @param string $search
     * @return string
     */
    public function beforeLast(string $search): string
    {
        return $search === '' ? $this->value() : value(function () use ($search) {
            if (false === $position = mb_strpos($this->value(), $search)) {
                return $this->value();
            }

            return mb_substr($this->value(), 0, $position);
        });
    }

    /**
     * Check string contains a needle
     *
     * @param $needles
     * @return bool
     */
    public function contains($needles): bool
    {
        return array_some((array)$needles, function ($needle) {
            return str_contains(strtolower($this->value()), strtolower($needle));
        });
    }

    /**
     * Alias of getStringableValue method
     *
     * @return ?string
     */
    private function value(): ?string
    {
        return $this->getStringableValue();
    }

    /**
     * Check string ends with a needle
     *
     * @param $needles
     * @return bool
     */
    public function endsWith($needles): bool
    {
        return array_some(
            (array)$needles, fn($needle) => str_ends_with($this->value(), $needle)
        );
    }

    /**
     * Check string equals to another
     *
     * @param $value
     * @return bool
     */
    public function eq($value): bool
    {
        return in_array($this->value(), (array)$value);
    }

    /**
     * Check string starts with a needle
     *
     * @param $needles
     * @return bool
     */
    public function startsWith($needles): bool
    {
        return array_some(
            (array)$needles, fn($needle) => str_starts_with($this->value(), $needle)
        );
    }

    /**
     * Trim string from whitespaces or specified characters
     *
     * @param string $characters
     * @return string
     */
    public function trim(string $characters = " \t\n\r\0\x0B"): string
    {
        return trim($this->value(), $characters);
    }

    abstract protected function getStringableValue(): ?string;
}