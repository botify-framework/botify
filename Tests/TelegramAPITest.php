<?php

namespace Botify;

use PHPUnit\Framework\TestCase;

class TelegramAPITest extends TestCase
{

    public function testFactory()
    {
        self::assertThat(TelegramAPI::factory() instanceof TelegramAPI,"");
    }
}
