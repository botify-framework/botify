<?php
ini_set('memory_limit', -1);
ini_set('max_execution_time', -1);

require_once __DIR__ . '/bootstrap/app.php';


use Jove\TelegramAPI;
use Jove\Types\Map\CallbackQuery;
use Jove\Types\Map\Message;
use Jove\Utils\FileSystem;

$bot = new TelegramAPI();

$bot->on('callback_query', function (CallbackQuery $callbackQuery) {
    yield $this->answer('Hi ' . $this->from->first_name);
});

$bot->on(['message', 'edited_message'], function (Message $message) {
    $text = $message->text ?: $message->caption;
    $from = $message->from;
    $isAllowed = $from->is_admin;

    if ($text === 'ping') {
        $mt = microtime(true);
        $replied = yield $message->reply('Please wait ...');
        yield $replied->edit(sprintf(
            'Took time is %s ms', round((microtime(true) - $mt) * 1000, 3)
        ));
    } elseif (preg_match('/^[\/#!.]?(j)\s+?(.*)$/usi', $text, $match) && $isAllowed) {
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
        } catch (Throwable $e) {
            $errors[] = $e->getMessage() . "\n" .
                'In Line : ' . $e->getLine() . "\n" .
                'At File : ' . basename($e->getFile());
        }
        $buffers = trim(implode("\n", $buffers));

        $result .= !empty($buffers) ? "<b>Result:</b>\n" . htmlspecialchars(
                $buffers
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

        if (mb_strlen($result, 'utf8') > 4096) {
            file_put_contents($file = new FileSystem(storage_path(sprintf(
                'result.%s', is_json($buffers) ? 'json' : 'txt'
            ))), $result);
            yield $this->replyDocument($file);
            yield $file->delete();
        } else {
            yield $message->reply($result);
        }


    }
});

$bot->hear();
