<?php


use Jove\Utils\Plugins\Plugin;
use const Jove\Utils\Plugins\Filter\IS_MESSAGE;

$filters = [
    IS_MESSAGE,
];

return Plugin::apply($filters, function () {
    yield $this->message->copy();
});