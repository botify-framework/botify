# async-php-bot

Create your own Telegram API bot asynchronously in PHP

## How to use

## Installation

- ** Install with git **

``` 
git clone https://github.com/botify-framework/botify 
```

- ** Install with composer **

``` 
composer create-project --prefer-dist botify-framework/botify 
```

### Webhook mode

```php
use Botify\Events\Handler;
use Botify\TelegramAPI;

require_once __DIR__ .'/bootstrap/app.php';

$bot = new TelegramAPI([
    'token' => '123456789:AAABBBCCCDDDEEE',
]);

$bot->loopAndHear(Handler::UPDATE_TYPE_WEBHOOK);
```

### Http server mode

```php
use Botify\Events\Handler;
use Botify\TelegramAPI;

require_once __DIR__ .'/bootstrap/app.php';

$bot = new TelegramAPI([
    'token' => '123456789:AAABBBCCCDDDEEE',
]);

$bot->loopAndHear(Handler::UPDATE_TYPE_SOCKET_SERVER);
```

### Long polling mode

```php
use Botify\Events\Handler;
use Botify\TelegramAPI;

require_once __DIR__ .'/bootstrap/app.php';

$bot = new TelegramAPI([
    'token' => '123456789:AAABBBCCCDDDEEE',
]);

$bot->loopAndHear(Handler::UPDATE_TYPE_POLLING);
```