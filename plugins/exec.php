<?php


use Jove\TelegramAPI;
use Jove\Types\Map\Message;
use Jove\Types\Update;
use Jove\Utils\Plugins\Pluggable;

$filters = [
    function (TelegramAPI $api, Update $update) {
        if ($message = $update['message'] ?? $update['edited_message'] ?? false) {
            return $message['from']['is_admin'] && $message->command(['run', 'exec', 'eval'], ['.', '#', '/', '$', '']);
        }
    },
];

return new class($filters) extends Pluggable {
    public function handle(Message $message)
    {
        $evalable = $message->matches[1];

        $errors = [];
        $buffers = [];
        $result = null;
        $runnable = <<<CODE
                use function Amp\call;
                \$__temp_vars = get_defined_vars();
                return call(function () use (\$__temp_vars) {
                    extract(\$__temp_vars);
                    unset(\$__temp_vars);
                    $evalable
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
};