<?php

namespace Botify\Traits;

use function Botify\array_some;
use function Botify\value;

trait Stringable
{
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
                return false;
            }

            return mb_substr($this->value(), $position + mb_strlen($search));
        });
    }

    /**
     * Alias of getStringableValue method
     *
     * @return ?string
     */
    private function value(): ?string
    {
        return (string)$this->getStringableValue();
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
                return false;
            }

            return mb_substr($this->value(), 0, $position);
        });
    }

    /**
     * Get string between 2 phrase
     *
     * @param $from
     * @param $to
     * @return string
     */
    public function between($from, $to): string
    {
        return static::of($this->after($from))->beforeLast($to);
    }

    /**
     * Create new instance
     *
     * @param $value
     * @return object
     */
    public static function of($value): object
    {
        return new class ($value) {
            use Stringable;

            public function __construct(public string $value)
            {
            }

            protected function getStringableValue(): ?string
            {
                return $this->value;
            }
        };
    }

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
     * Check string contains a needle
     *
     * @param $needles
     * @param bool $case
     * @return bool
     */
    public function contains($needles, bool $case = false): bool
    {
        $value = $this->value();

        if ($case === true) {
            $value = strtolower($value);
            $needles = array_map('strtolower', (array)$needles);
        }

        return array_some((array)$needles, function ($needle) use ($value) {
            return $needle !== '' && str_contains($value, $needle);
        });
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