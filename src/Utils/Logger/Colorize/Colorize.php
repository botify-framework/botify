<?php

namespace Botify\Utils\Logger\Colorize;

use function Botify\concat;
use function Botify\env;
use function Botify\sprintln;

class Colorize
{
    const RESET = "\e[0m";

    public static function alert($text)
    {
        return static::apply($text, Color::BLACK, Background::LIGHT_YELLOW);
    }

    public static function apply(
        $text,
        $color = Color::WHITE,
        $background = Background::DEFAULT,
        $entity = Entity::BOLD): string
    {
        return sprintln(
            env('APP_RUNNING_IN_CONSOLE') ?? in_array(PHP_SAPI, ['php-dbg', 'cli'])
                ? concat($color, $background, $entity, $text, static::RESET)
                : $text
        );
    }

    public static function critical($text)
    {
        return static::apply($text, Color::WHITE, Background::LIGHT_RED);
    }

    public static function debug($text)
    {
        return static::apply($text, Color::GREEN);
    }

    public static function emergency($text)
    {
        return static::apply($text, Color::BLACK, Background::RED);
    }

    public static function error($text)
    {
        return static::apply($text, Color::LIGHT_RED, Background::BLACK);
    }

    public static function info($text)
    {
        return static::apply($text, Color::BLUE, Background::WHITE);
    }

    public static function log($level, $text)
    {
        return call_user_func_array([static::class, $level], [$text]);
    }

    public static function notice($text)
    {
        return static::apply($text, Color::WHITE, Background::DARK_GRAY);
    }

    public static function warning($text)
    {
        return static::apply($text, Color::BLACK, Background::YELLOW);
    }
}