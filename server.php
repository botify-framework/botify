<?php

require_once __DIR__ . '/bootstrap/app.php';


use Jove\EventHandler;
use Jove\TelegramAPI;
use Jove\Types\Map\Message;

$bot = new TelegramAPI();

$bot->on('message', function (Message $message) {
    $text = $message->text;
    $fromId = $message->from->id;
    $isAdmin = in_array($fromId, config('telegram.admins'));
    $isOwner = $fromId === config('telegram.owner');

    if ($text === 'ping') {
        $replied = yield $message->reply('Please wait ...');
        yield $replied->edit(sprintf(
            'Took time is %s ms', round(microtime(true) - START_TIME, 3)
        ));
    } elseif (preg_match('/^[\/#!.]?(j)\s+?(.*)$/usi', $text, $match) && $isAdmin) {
        $errors = [];
        $buffers = [];
        $result = null;
        $runnable = <<<CODE
\$__temp_vars = get_defined_vars();
return \Amp\call(function () use (\$__temp_vars) {
    extract(\$__temp_vars);
    unset(\$__temp_vars);
    $match[2]
});
CODE;
        set_error_handler(function ($errno, $message) use (&$errors) {
            $errors[] = $message;
        });
        ob_start();

        try {
            yield eval($runnable);
            $buffers[] = ob_get_contents();
        } catch (\Throwable $e) {
            $errors[] = $e->getMessage() . "\n" .
                'In Line : ' . $e->getLine() . "\n" .
                'At File : ' . basename($e->getFile());
        }

        $result .= !empty($buffers) ? "<b>Result:</b>\n" . htmlspecialchars(
                implode("\n", $buffers)
            ) . "\n" : null;

        $result .= !empty($errors) ? "<b>Errors:</b>\n" . htmlspecialchars(
                implode("\n", $errors)
            ) : null;

        ob_end_clean();

        if (empty($result)) {
            return yield $message->reply('No Response !');
        }


        mb_regex_encoding('UTF-8');
        mb_internal_encoding('UTF-8');

        $responses = str_split($result, 4000);
        foreach ($responses as $response) {
            yield $message->reply($response);
        }
    }
});

$bot->hear(EventHandler::UPDATE_TYPE_WEBHOOK);