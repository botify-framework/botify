<?php

namespace Botify\Utils\Logger\Colorize;

class Entity
{
    const DEFAULT = '';
    const BOLD = "\e[1m";
    const UN_BOLD = "\e[21m";
    const DIM = "\e[2m";
    const UN_DIM = "\e[22m";
    const UNDERLINED = "\e[4m";
    const UN_UNDERLINED = "\e[24m";
    const BLINK = "\e[5m";
    const UN_BLINK = "\e[25m";
    const REVERSE = "\e[7m";
    const UN_REVERSE = "\e[27m";
    const HIDDEN = "\e[8m";
    const UN_HIDDEN = "\e[28m";
}