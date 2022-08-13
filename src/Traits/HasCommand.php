<?php

namespace Botify\Traits;

use function Botify\array_some;
use function Botify\value;

trait HasCommand
{
    private array $flags = ['u', 's'];

    public function command($commands, array $prefixes = ['/', '!', '#'], bool $caseInsensitive = true): bool
    {
        if ($caseInsensitive) {
            $this->flags[] = 'i';
        }

        $flags = preg_quote(implode($this->flags));
        $_prefixes = preg_quote(implode($prefixes), '/');
        $prefixes = empty($_prefixes) ? '' : '[' . $_prefixes . ']' . value(function () use ($prefixes) {
                if (in_array('', $prefixes)) {
                    return '?';
                }
            });

        return array_some((array)$commands, function ($command) use ($flags, $prefixes) {
            $pattern = '/^' . $prefixes . preg_quote($command) . '(?:\s|$)/' . $flags;

            if (preg_match($pattern, $this->getText(), $matches)) {
                $matches[] = trim($this->after($matches[0]));

                $this->_setProperty('matches', array_filter(array_map('trim', $matches)));

                return true;
            }
        });
    }

    public function regex($pattern, int $flags = 0, int $offset = 0): bool
    {
        if (preg_match($pattern, $this->getText(), $matches, $flags, $offset)) {
            $this->_setProperty('matches', $matches);

            return true;
        }

        return false;
    }

    private function getText(): string
    {
        return $this->text ?? $this->caption ?? '';
    }
}