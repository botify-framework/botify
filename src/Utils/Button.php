<?php

namespace Botify\Utils;

use function Botify\array_some;

class Button
{
    /**
     * @var array
     */
    private array $defaults = [
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
    ];


    /**
     * Keyboard constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->defaults = array_merge($this->defaults, $options);
    }


    /**
     * @param $rows
     * @param array $options
     * @param bool $json
     * @return mixed
     */
    public static function make($rows, array $options = [], $json = true): mixed
    {
        $keyboard = new static($options);

        $array = $keyboard->isInlineKeyboard($rows)
            ? $keyboard->inlineKeyboard($rows)
            : $keyboard->keyboard($rows);

        return $json ? json_encode($array) : $array;
    }

    /**
     * @param array $rows
     * @return bool
     */
    private function isInlineKeyboard(array $rows): bool
    {
        return !empty($rows) && array_some($rows[0], fn($item) => isset($item[1]) && is_string($item[1]));
    }

    /**
     * @param array $rows
     * @return array
     */
    public function inlineKeyboard(array $rows): array
    {
        $inline_keyboard = [];

        foreach ($rows as $row) {
            $columns = [];
            foreach ($row as $column)
                $columns[] = match ($column[2] ?? 1) {
                    1 => ['text' => $column[0], 'callback_data' => $column[1]],
                    2 => ['text' => $column[0], 'url' => $column[1]],
                    3 => ['text' => $column[0], 'switch_inline_query' => $column[1]],
                    4 => ['text' => $column[0], 'switch_inline_query_current_chat' => $column[1]],
                    5 => ['text' => $column[0], 'callback_game' => $column[1]]
                };

            $inline_keyboard[] = $columns;
        }

        return array_merge($this->defaults, compact(
            'inline_keyboard'
        ));
    }

    /**
     * @param array $rows
     * @return array
     */
    public function keyboard(array $rows): array
    {
        $keyboard = [];

        foreach ($rows as $row) {
            $columns = [];
            foreach ($row as $column)
                $columns[] = match ($column[1] ?? 1) {
                    1 => ['text' => $column[0]],
                    2 => ['text' => $column[0], 'request_contact' => true],
                    3 => ['text' => $column[0], 'request_location' => true],
                };

            $keyboard[] = $columns;
        }

        return array_merge($this->defaults, compact(
            'keyboard'
        ));
    }

    public static function remove(): string
    {
        return json_encode([
            'remove_keyboard' => true,
        ]);
    }
}