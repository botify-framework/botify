<?php

namespace Jove\Methods\Commons;

use Amp\Promise;
use function Amp\call;

trait GetDownloadableLink
{
    private string $url = 'https://api.telegram.org/file/bot%s/%s';

    /**
     * @param string $fileId
     * @return Promise|array
     */
    protected function getDownloadableLink(string $fileId): Promise
    {
        return call(function () use ($fileId) {
            $file = yield $this->getFile(
                file_id: $fileId
            );

            if ($file->isSuccess()) {
                return [$file->file_path, sprintf($this->url, getenv('BOT_TOKEN'), $file->file_path)];
            }

            return false;
        });
    }
}