<?php

namespace Jove\Methods\Commons;

use Amp\Promise;
use function Amp\call;

trait GetDownloadableLink
{
    private string $url = 'https://api.telegram.org/file/bot%s/%s';

    public function getDownloadableLink(string $fileId): Promise
    {
        return call(function () use ($fileId) {
            $file = yield $this->getFile(
                file_id: $fileId
            );

            if ($file->isSuccess()) {
                return sprintf($this->url, getenv('BOT_TOKEN'), $file->file_path);
            }

            return false;
        });
    }
}