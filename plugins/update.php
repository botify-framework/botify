<?php


use Botify\Types\Map\Message;
use Botify\Utils\Plugins\Plugin;

use Botify\Utils\FileSystem;
use function Botify\storage_path;

return Plugin::apply(function (Message $message) {
    if ($message->command('update')) {
        $update = json_encode($message->toArray(), 448);
        mb_regex_encoding('UTF-8');
        mb_internal_encoding('UTF-8');
        if (mb_strlen($update, 'utf8') > 4096) {
            $file = new FileSystem(storage_path(
                'update.json'
            ));
            yield $file->put($update);
            yield $message->replyDocument($file);
            return yield $file->delete();
        } else {
            return yield $message->reply($update);
        }
    }
});