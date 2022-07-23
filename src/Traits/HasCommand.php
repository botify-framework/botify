<?php

namespace Jove\Traits;

trait HasCommand
{
    private array $flags = ['u', 's'];

    public function command($commands, array $prefixes = ['/', '!', '#'], bool $caseInsensitive = true): bool
    {
        if ($caseInsensitive) {
            $this->flags[] = 'i';
        }

        $flags = preg_quote(implode($this->flags));
        $prefixes = '[' . preg_quote(implode($prefixes), '/') . ']' . value(function () use ($prefixes) {
                if (in_array('', $prefixes)) {
                    return '?';
                }
            });

        return array_some((array)$commands, function ($command) use ($flags, $prefixes) {
            $pattern = '/^' . $prefixes . preg_quote($command) . '(?:\s|$)/' . $flags;

            if (preg_match($pattern, $this->getText(), $matches)) {
                $matches[] = trim($this->after($matches[0]));

                $this->_setProperty('matches', array_map('trim', $matches));

                return true;
            }
        });
    }

    private function getText(): string
    {
        return $this->text ?? $this->caption ?? '';
    }
}